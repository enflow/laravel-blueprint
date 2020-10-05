var Turbolinks = require("turbolinks");
Turbolinks.start();

(function () {
    var scrollTop = 0;

    function findElements() {
        return document.querySelectorAll("[data-turbolinks-permanent]");
    }

    addEventListener("turbolinks:before-render", function () {
        findElements().forEach(function (element) {
            scrollTop = document.scrollingElement.scrollTop;
        })
    })

    addEventListener("turbolinks:render", function () {
        findElements().forEach(function (element) {
            if (scrollTop) {
                document.scrollingElement.scrollTo(0, scrollTop);
            }
        })
    })
})();
