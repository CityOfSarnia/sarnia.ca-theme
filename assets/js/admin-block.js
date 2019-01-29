wp.hooks.addFilter("blocks.registerBlockType", "sarnia.ca-theme", function(
  settings,
  name
) {
  if (name === "core/file") {
    return lodash.assign({}, settings, {
      supports: lodash.assign({}, settings.supports, {
        align: false
      })
    });
  }
  if (name === "core/heading") {
    return lodash.assign({}, settings, {
      supports: lodash.assign({}, settings.supports, {
        align: ["wide"]
      })
    });
  }
  return settings;
});
