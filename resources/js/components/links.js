// document.addEventListener("turbolinks:load", function () {
//     var links = document.querySelectorAll("[data-href]");
//
//     for (let i = 0; i < links.length; i++) {
//         links[i].addEventListener('click', function (e) {
//             if (this.dataset.href.indexOf('#') === 0) {
//                 window.location.href = this.dataset.href;
//             } else if (e.ctrlKey || e.shiftKey || this.dataset.target === '_blank') {
//                 window.open(this.dataset.href, '_blank');
//             } else {
//                 Turbolinks.visit(this.dataset.href);
//             }
//
//             return false;
//         });
//
//         // Sublinks.
//         var nestedLinks = links[i].querySelectorAll('a');
//         for (let i = 0; i < nestedLinks.length; i++) {
//             nestedLinks[i].addEventListener('click', function (e) {
//                 e.preventDefault();
//                 e.stopPropagation();
//
//                 if (e.ctrlKey || e.shiftKey || this.target === '_blank') {
//                     window.open(this.href, '_blank');
//                 } else {
//                     Turbolinks.visit(this.href);
//                 }
//
//                 return false;
//             });
//         }
//     }
// });
