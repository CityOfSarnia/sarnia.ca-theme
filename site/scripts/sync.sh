#!/bin/bash

# Syncing Trellis & Bedrock-based WordPress environments with WP-CLI aliases
# Version 1.1.0
# Copyright (c) Ben Word

LOCALDIR="web/app/uploads/"
LOCALSITE="https://local.sarnia.ca"

DEVDIR="web@300US18-WEB007.bhs7.cos.city.sarnia.on.ca:/srv/www/sarnia.ca/shared/uploads/"
DEVSITE="https://dev.sarnia.ca"

EDITDIR="web@300US18-WEB003.bhs7.cos.city.sarnia.on.ca:/srv/www/sarnia.ca/shared/uploads/"
EDITSITE="https://beta.sarnia.ca"

STAGDIR="web@300US18-WEB005.bhs7.cos.city.sarnia.on.ca:/srv/www/sarnia.ca/shared/uploads/"
STAGSITE="https://staging.sarnia.ca"

FROM=$1
TO=$2
LOCAL=false

if [[ $3 == "--local" ]]; then
  LOCAL=true
fi

bold=$(tput bold)
normal=$(tput sgr0)

case "$1-$2" in
  edit-local)          DIR="down ⬇️ "           FROMSITE=$EDITSITE;  FROMDIR=$EDITDIR;  TOSITE=$LOCALSITE; TODIR=$LOCALDIR; ;;
  staging-local)       DIR="down ⬇️ "           FROMSITE=$STAGSITE;  FROMDIR=$STAGDIR;  TOSITE=$LOCALSITE; TODIR=$LOCALDIR; ;;
  development-local)   DIR="down ⬇️ "           FROMSITE=$DEVSITE;   FROMDIR=$DEVDIR;   TOSITE=$LOCALSITE; TODIR=$LOCALDIR; ;;
  local-edit)          DIR="up ⬆️ "             FROMSITE=$LOCALSITE; FROMDIR=$LOCALDIR; TOSITE=$EDITSITE;  TODIR=$EDITDIR; ;;
  local-staging)       DIR="up ⬆️ "             FROMSITE=$LOCALSITE; FROMDIR=$LOCALDIR; TOSITE=$STAGSITE;  TODIR=$STAGDIR; ;;
  local-development)   DIR="up ⬆️ "             FROMSITE=$LOCALSITE; FROMDIR=$LOCALDIR; TOSITE=$DEVSITE;   TODIR=$DEVDIR; ;;
  edit-staging)        DIR="horizontally ↔️ ";  FROMSITE=$EDITSITE;  FROMDIR=$EDITDIR;  TOSITE=$STAGSITE;  TODIR=$STAGDIR; ;;
  edit-development)    DIR="horizontally ↔️ ";  FROMSITE=$EDITSITE;  FROMDIR=$EDITDIR;  TOSITE=$DEVSITE;   TODIR=$DEVDIR; ;;
  staging-edit)        DIR="horizontally ↔️ ";  FROMSITE=$STAGSITE;  FROMDIR=$STAGDIR;  TOSITE=$EDITSITE;  TODIR=$EDITDIR; ;;
  staging-development) DIR="horizontally ↔️ ";  FROMSITE=$STAGSITE;  FROMDIR=$STAGDIR;  TOSITE=$DEVSITE;   TODIR=$DEVDIR; ;;
  development-staging) DIR="horizontally ↔️ ";  FROMSITE=$DEVSITE;   FROMDIR=$DEVDIR;   TOSITE=$STAGSITE;  TODIR=$STAGDIR; ;;
  development-edit)    DIR="horizontally ↔️ ";  FROMSITE=$DEVSITE;   FROMDIR=$DEVDIR;   TOSITE=$EDITSITE;  TODIR=$EDITDIR; ;;
  *) echo "usage: $0 edit local | staging local | development local | local edit | local staging | local development | edit staging | edit development | staging edit | staging development | development staging | development edit" && exit 1 ;;
esac

read -r -p "
🔄  Would you really like to ⚠️  ${bold}reset the $TO database${normal} ($TOSITE)
    and sync ${bold}$DIR${normal} from $FROM ($FROMSITE)? [y/N] " response

if [[ "$response" =~ ^([yY][eE][sS]|[yY])$ ]]; then
  # Change to site directory
  cd ../ &&
  echo

  # Make sure both environments are available before we continue
  availfrom() {
    local AVAILFROM

    if [[ "$LOCAL" = true && $FROM == "local" ]]; then
      AVAILFROM=$(wp option get home 2>&1)
    else
      AVAILFROM=$(wp "@$FROM" option get home 2>&1)
    fi
    if [[ $AVAILFROM == *"Error"* ]]; then
      echo "❌  Unable to connect to $FROM"
      exit 1
    else
      echo "✅  Able to connect to $FROM"
    fi
  };
  availfrom

  availto() {
    local AVAILTO
    if [[ "$LOCAL" = true && $TO == "local" ]]; then
      AVAILTO=$(wp option get home 2>&1)
    else
      AVAILTO=$(wp "@$TO" option get home 2>&1)
    fi

    if [[ $AVAILTO == *"Error"* ]]; then
      echo "❌  Unable to connect to $TO"
      exit 1
    else
      echo "✅  Able to connect to $TO"
    fi
  };
  availto
  echo

  # Export/import database, run search & replace
  if [[ "$LOCAL" = true && $TO == "local" ]]; then
    wp db export &&
    wp db reset --yes &&
    wp "@$FROM" db export - | wp db import - &&
    wp search-replace "$FROMSITE" "$TOSITE"
  elif [[ "$LOCAL" = true && $FROM == "local" ]]; then
    wp "@$TO" db export &&
    wp "@$TO" db reset --yes &&
    wp db export - | wp "@$TO" db import - &&
    wp "@$TO" search-replace "$FROMSITE" "$TOSITE"
  else
    wp "@$TO" db export &&
    wp "@$TO" db reset --yes &&
    wp "@$FROM" db export - | wp "@$TO" db import - &&
    wp "@$TO" search-replace "$FROMSITE" "$TOSITE"
  fi

  # Sync uploads directory
  chmod -R 755 web/app/uploads/ &&
  if [[ $DIR == "horizontally"* ]]; then
    [[ $FROMDIR =~ ^(.*): ]] && FROMHOST=${BASH_REMATCH[1]}
    [[ $FROMDIR =~ ^(.*):(.*)$ ]] && FROMDIR=${BASH_REMATCH[2]}
    [[ $TODIR =~ ^(.*): ]] && TOHOST=${BASH_REMATCH[1]}
    [[ $TODIR =~ ^(.*):(.*)$ ]] && TODIR=${BASH_REMATCH[2]}

    ssh -o ForwardAgent=yes $FROMHOST "rsync -aze 'ssh -o StrictHostKeyChecking=no' --progress $FROMDIR $TOHOST:$TODIR"
  else
    rsync -az --progress "$FROMDIR" "$TODIR"
  fi

  # Slack notification when sync direction is up or horizontal
  # if [[ $DIR != "down"* ]]; then
  #   USER="$(git config user.name)"
  #   curl -X POST -H "Content-type: application/json" --data "{\"attachments\":[{\"fallback\": \"\",\"color\":\"#36a64f\",\"text\":\"🔄 Sync from ${FROMSITE} to ${TOSITE} by ${USER} complete \"}],\"channel\":\"#site\"}" https://hooks.slack.com/services/xx/xx/xx
  # fi
  echo -e "\n\n🔄  Sync from $FROM to $TO complete.\n\n    ${bold}$TOSITE${normal}\n"
fi
