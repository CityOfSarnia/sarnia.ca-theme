#!/bin/bash

# Syncing Trellis & Bedrock-based WordPress environments with WP-CLI aliases
# Version 1.1.0
# Copyright (c) Ben Word

LOCALDIR="web/app/uploads/"
LOCALSITE="https://local.sarnia.ca"

PRODDIR="web@ip-10-30-11-8.ca-central-1.compute.internal:/srv/www/sarnia.ca/shared/uploads/"
PRODSITE="https://www.sarnia.ca"

STAGDIR="web@ip-10-30-14-118.ca-central-1.compute.internal:/srv/www/sarnia.ca/shared/uploads/"
STAGSITE="https://staging.sarnia.ca"

DEVDIR="web@ip-10-30-17-40.ca-central-1.compute.internal:/srv/www/sarnia.ca/shared/uploads/"
DEVSITE="https://dev.sarnia.ca"

BACKUPDIR="web@ip-10-137-11-43.ca-central-1.compute.internal:/srv/www/sarnia.ca/shared/uploads/"
BACKUPSITE="https://www.sarnia.ca"

FROM=$1
TO=$2
LOCAL=false

if [[ $3 == "--local" ]]; then
  LOCAL=true
fi

bold=$(tput bold)
normal=$(tput sgr0)

case "$1-$2" in
  prod-local)          DIR="down ⬇️ "           FROMSITE=$PRODSITE;  FROMDIR=$PRODDIR;  TOSITE=$LOCALSITE; TODIR=$LOCALDIR; ;;
  staging-local)       DIR="down ⬇️ "           FROMSITE=$STAGSITE;  FROMDIR=$STAGDIR;  TOSITE=$LOCALSITE; TODIR=$LOCALDIR; ;;
  development-local)   DIR="down ⬇️ "           FROMSITE=$DEVSITE;   FROMDIR=$DEVDIR;   TOSITE=$LOCALSITE; TODIR=$LOCALDIR; ;;
  local-prod)          DIR="up ⬆️ "             FROMSITE=$LOCALSITE; FROMDIR=$LOCALDIR; TOSITE=$PRODSITE;  TODIR=$PRODDIR; ;;
  local-staging)       DIR="up ⬆️ "             FROMSITE=$LOCALSITE; FROMDIR=$LOCALDIR; TOSITE=$STAGSITE;  TODIR=$STAGDIR; ;;
  local-development)   DIR="up ⬆️ "             FROMSITE=$LOCALSITE; FROMDIR=$LOCALDIR; TOSITE=$DEVSITE;   TODIR=$DEVDIR; ;;
  local-backup)        DIR="up ⬆️ "             FROMSITE=$LOCALSITE; FROMDIR=$LOCALDIR; TOSITE=$BACKUPSITE;TODIR=$BACKUPDIR; ;;
  prod-staging)        DIR="horizontally ↔️ ";  FROMSITE=$PRODSITE;  FROMDIR=$PRODDIR;  TOSITE=$STAGSITE;  TODIR=$STAGDIR; ;;
  prod-development)    DIR="horizontally ↔️ ";  FROMSITE=$PRODSITE;  FROMDIR=$PRODDIR;  TOSITE=$DEVSITE;   TODIR=$DEVDIR; ;;
  staging-prod)        DIR="horizontally ↔️ ";  FROMSITE=$STAGSITE;  FROMDIR=$STAGDIR;  TOSITE=$PRODSITE;  TODIR=$PRODDIR; ;;
  staging-development) DIR="horizontally ↔️ ";  FROMSITE=$STAGSITE;  FROMDIR=$STAGDIR;  TOSITE=$DEVSITE;   TODIR=$DEVDIR; ;;
  development-staging) DIR="horizontally ↔️ ";  FROMSITE=$DEVSITE;   FROMDIR=$DEVDIR;   TOSITE=$STAGSITE;  TODIR=$STAGDIR; ;;
  development-prod)    DIR="horizontally ↔️ ";  FROMSITE=$DEVSITE;   FROMDIR=$DEVDIR;   TOSITE=$PRODSITE;  TODIR=$PRODDIR; ;;
  *) echo "usage: $0 prod local | staging local | development local | local prod | local staging | local development | prod staging | prod development | staging prod | staging development | development staging | development prod" && exit 1 ;;
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
