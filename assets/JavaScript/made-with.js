// Import all images required, see https://vitejs.dev/guide/assets.html
import typo3Logo from '../Image/Icon/typo3.svg?url'
document.querySelector('.js-made-with').innerHTML = `${TYPO3.lang["site-distribution.made-with"]} <img width="20px" height="20px" src="${typo3Logo}" alt="TYPO3">`
