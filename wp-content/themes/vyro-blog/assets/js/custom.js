jQuery(function ($) {
  /* -----------------------------------------
  Preloader
  ----------------------------------------- */
  $("#preloader").delay(1000).fadeOut();
  $("#loader").delay(1000).fadeOut("slow");
  
  /* -----------------------------------------
  rtl
  ----------------------------------------- */
  var isRTL = $("html").attr("dir") === "rtl";
  
  /* -----------------------------------------
  Toggle Button
  ----------------------------------------- */
  $(".menu-toggle").click(function () {
    $(this).toggleClass("show");
  });
  
  /* -----------------------------------------
  Keyboard Navigation
  ----------------------------------------- */
  $(window).on("load resize", function () {
    if ($(window).width() < 992 && $(window).width() >= 991) {
      $(".main-navigation").find("a").unbind("keydown");
      $(".main-navigation")
      .find("li")
      .last()
      .bind("keydown", function (e) {
        if (e.which === 9) {
          e.preventDefault();
          $("#masthead").find(".menu-toggle").focus();
        }
      });
    } else if ($(window).width() < 992) {
      $(".main-navigation").find("li").unbind("keydown");
      $(".main-navigation")
      .find("a")
      .last()
      .bind("keydown", function (e) {
        if (e.which === 9) {
          e.preventDefault();
          $("#masthead").find(".menu-toggle").focus();
        }
      });
    } else {
      $(".main-navigation").find("li").unbind("keydown");
      $(".main-navigation").find("a").unbind("keydown");
    }
  });
  
  var vyro_blog_primary_menu_toggle = $("#masthead .menu-toggle");
  vyro_blog_primary_menu_toggle.on("keydown", function (e) {
    var tabKey = e.keyCode === 9;
    var shiftKey = e.shiftKey;
    
    if (vyro_blog_primary_menu_toggle.hasClass("show")) {
      if (shiftKey && tabKey) {
        e.preventDefault();
        $(".main-navigation").toggleClass("toggled");
        vyro_blog_primary_menu_toggle.removeClass("show");
      }
    }
  });
  
  $(".header-search-wrap")
  .find(".search-submit")
  .bind("keydown", function (e) {
    var tabKey = e.keyCode === 9;
    if (tabKey) {
      e.preventDefault();
      $(".search-icon").focus();
    }
  });
  
  $(".search-icon").on("keydown", function (e) {
    var tabKey = e.keyCode === 9;
    var shiftKey = e.shiftKey;
    if ($(".header-search-wrap").hasClass("show")) {
      if (shiftKey && tabKey) {
        e.preventDefault();
        $(".header-search-wrap").removeClass("show");
        $(".search-icon").focus();
      }
    }
  });
  
  /* -----------------------------------------
  Header Search Bar
  ----------------------------------------- */
  var vyro_blog_searchWrap = $(".header-search-wrap");
  $(".search-icon").click(function (e) {
    e.preventDefault();
    vyro_blog_searchWrap.toggleClass("show");
    vyro_blog_searchWrap.find("input.search-field").focus();
  });
  $(document).click(function (e) {
    if (!vyro_blog_searchWrap.is(e.target) && !vyro_blog_searchWrap.has(e.target).length) {
      $(".header-search-wrap").removeClass("show");
    }
  });
  
  /* -----------------------------------------
  Scroll To Top Button
  ----------------------------------------- */
  var vyro_blog_scroll_btn = $(".scroll-to-top");
  
  $(window).scroll(function () {
    if ($(window).scrollTop() > 400) {
      vyro_blog_scroll_btn.addClass("show");
    } else {
      vyro_blog_scroll_btn.removeClass("show");
    }
  });
  
  vyro_blog_scroll_btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate(
    {
      scrollTop: 0,
    },
    "300"
    );
  });
});