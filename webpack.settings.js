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
            base: "./dist",
            clean: [
                '**/*',
            ]
        },
        templates: "./templates/"
    },
    urls: {
        live: "https://sarnia.ca/",
        local: "http://sarnia.local/",
        critical: "http://sarnia.ca/",
        publicPath: () => process.env.PUBLIC_PATH || "/assets/",
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
    copyWebpackConfig: [
        {
            from: "./src/js/workbox-catch-handler.js",
            to: "js/[name].[ext]"
        }
    ],
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
    saveRemoteFileConfig: [
        // {
        //     url: "https://www.google-analytics.com/analytics.js",
        //     filepath: "js/analytics.js"
        // }
    ],
    createSymlinkConfig: [
        // {
        //     origin: "img/favicons/favicon.ico",
        //     symlink: "../favicon.ico"
        // }
    ],
    webappConfig: {
        logo: "./source/img/favicon-src.png",
        prefix: "img/favicons/"
    },
    workboxConfig: {
        swDest: "../sw.js",
        precacheManifestFilename: "js/precache-manifest.[manifestHash].js",
        importScripts: [
            "/assets/js/workbox-catch-handler.js"
        ],
        exclude: [
            /\.(png|jpe?g|gif|svg|webp)$/i,
            /\.map$/,
            /^manifest.*\\.js(?:on)?$/,
        ],
        globDirectory: "./web/",
        globPatterns: [
            "offline.html",
            "offline.svg"
        ],
        offlineGoogleAnalytics: true,
        runtimeCaching: [
            {
                urlPattern: /\.(?:png|jpg|jpeg|svg|webp)$/,
                handler: "cacheFirst",
                options: {
                    cacheName: "images",
                    expiration: {
                        maxEntries: 20
                    }
                }
            }
        ]
    }
};