// Import our CSS
import '../sass/main.scss';

// javascript entry point
// import x from 'y';
// x.foobar();

// Accept HMR as per: https://webpack.js.org/api/hot-module-replacement#accept
if (module.hot) {
  module.hot.accept();
}