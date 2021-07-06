jQuery(document).ready(function ($) {
  favicon();
  //FIXED HEADER
  window.onscroll = function () {
    if (window.pageYOffset > 140) {
      $("#header").addClass("active");
    } else {
      $("#header").removeClass("active");
    }
  };

  //OWL
  $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 30,
    autoplay: true,
    autoplayTimeout: 6000,
    dots: true,
    lazyLoad: true,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1,
      },
      1000: {
        items: 2,
      },
    },
  });
});

$('#nav-principal').bootnavbar();

function favicon() {
  var link = document.querySelector("link[rel~='icon']");
  if (!link) {
      obj = { route: base_url + 'institucional-common-header/getfavicon' };
      var promise = global.rAjax(obj, true, true, false, false);
      promise.done(function (data) {
          if (data.success) {
              let src = data.response.src;
              link = document.createElement('link');
              link.rel = 'icon';
              link.type = 'mage/x-icon';
              document.getElementsByTagName('head')[0].appendChild(link);
              if (src)
                  link.href = src;
          }

      });
  }
}