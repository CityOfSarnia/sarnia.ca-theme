require('dotenv').config();

// Webpack settings exports
module.exports = {
    name: "sarnia.ca Theme",
    copyright: "Corporation of the City of Sarnia",
    paths: {
        src: {
            base: "./source/",
            css: "./source/sass/",
            js: "./source/js/"
        },
        dist: {
            base: "./assets/dist",
            clean: [
                '**/*',
                '!**/.gitkeep'
            ]
        },
        templates: "./templates/"
    },
    urls: {
        live: "https://sarnia.ca/",
        local: "http://sarnia.local/",
        critical: "http://sarnia.ca/",
        publicPath: () => process.env.PUBLIC_PATH || "/app/themes/sarnia.ca-theme/assets/dist/",
    },
    vars: {
        cssName: "styles"
    },
    entries: {
        "app": "app.js"
    },
    babelLoaderConfig: {
        exclude: [
            /(node_modules|bower_components)/
        ],
    },
    copyWebpackConfig: [],
    criticalCssConfig: {
        base: "./assets/",
        suffix: "_critical.min.css",
        criticalHeight: 1200,
        criticalWidth: 1200,
        ampPrefix: "amp_",
        ampCriticalHeight: 19200,
        ampCriticalWidth: 600,
        pages: [
            // {
            //     url: "",
            //     template: "index"
            // }
        ]
    },
    devServerConfig: {
        public: () => process.env.DEVSERVER_PUBLIC || "http://localhost:8080",
        host: () => process.env.DEVSERVER_HOST || "localhost",
        poll: () => process.env.DEVSERVER_POLL || false,
        port: () => process.env.DEVSERVER_PORT || 8080,
        https: () => process.env.DEVSERVER_HTTPS || false,
    },
    manifestConfig: {
        basePath: ""
    },
    purgeCssConfig: { // PurgeCSS is disabled in webpack.prod.js
        paths: [
            "./templates/**/*.{twig,html}",
            "./source/vue/**/*.{vue,html}"
        ],
        whitelist: [
            "./source/css/components/**/*.{css}"
        ],
        whitelistPatterns: [],
        extensions: [
            "html",
            "js",
            "twig",
            "vue"
        ]
    },
    createSymlinkConfig: [
        // {
        //     origin: "img/favicons/favicon.ico",
        //     symlink: "../favicon.ico"
        // }
    ]
};
