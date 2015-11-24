//
// (function (window) {
//   window.createReactField = function (
//     componentName,
//     componentID,
//     actionHandler,
//     props) {
//     var node = document.getElementById(componentID);
//     var root = document.createElement('div');
//     root.setAttribute('id', componentID);
//     root.setAttribute('class', componentName + '_Root');
//     node.parentNode.replaceChild(root, node);
//     window.React.render(
//       componentName,
//       props,
//       node
//     );
//   }
// })(window);
