// Allow Hot Module Replacement (HMR) for JS files
// For more details see https://vitejs.dev/guide/api-hmr.html
if (import.meta.hot) {
  import.meta.hot.accept();
}

// Scss entrypoint
import "./Scss/app.scss";
import "./JavaScript/made-with.js";

// Import favicons
import './Image/Icon/favicon.png?url'
import './Image/Icon/favicon.svg?url'
import './Image/Icon/favicon-touch.png?url'

// TYPO3.lang contains all available inline labels
console.log("Say hi! " + TYPO3.lang["site-distribution.welcome"]);
