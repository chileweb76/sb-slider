jQuery(document).ready(function ($) {
  var slides = $(".index");
  var title = $(".scrapbook_title");
  var content = $(".scrapbook_content");
  var main_image = $(".scrapbook_main_image");
  var thumbnailLeft = $(".scrapbook_thumbnail_left");
  var thumbnailRight = $(".scrapbook_thumbnail_right");
  var button1 = $(".scrapbook_button1");
  var button2 = $(".scrapbook_button2");
  var button3 = $(".scrapbook_button3");
  var button4 = $(".scrapbook_button4");
  var button5 = $(".scrapbook_button5");
  var button6 = $(".scrapbook_button6");

  var slideIndex = 0;
  var leftIndex = 1;
  var rightIndex = slides.length - 1;
  var intervalId = null;

  if (slides.length > 0) {
    $(title[slideIndex]).addClass("current").removeClass("remove");
    $(content[slideIndex]).addClass("current").removeClass("remove");
    $(main_image[slideIndex]).addClass("current").removeClass("remove");
    $(thumbnailLeft[leftIndex]).addClass("current").removeClass("remove");
    $(thumbnailRight[rightIndex]).addClass("current").removeClass("remove");
    $(button1[slideIndex]).addClass("current").removeClass("remove");
    $(button2[slideIndex]).addClass("current").removeClass("remove");
    $(button3[slideIndex]).addClass("current").removeClass("remove");
    $(button4[slideIndex]).addClass("current").removeClass("remove");
    $(button5[slideIndex]).addClass("current").removeClass("remove");
    $(button6[slideIndex]).addClass("current").removeClass("remove");
    $(".current").show();
    $(".remove").hide();
  }

  function showSlide() {
    if (slideIndex >= slides.length) {
      slideIndex = 0;
    } else if (slideIndex < 0) {
      slideIndex = slides.length - 1;
    }

    if (leftIndex >= slides.length) {
      leftIndex = 0;
    } else if (leftIndex < 0) {
      leftIndex = slides.length - 1;
    }

    if (rightIndex >= slides.length) {
      rightIndex = 0;
    } else if (rightIndex < 0) {
      rightIndex = slides.length - 1;
    }
    $(title).each(function () {
      $(this).removeClass("current").addClass("remove");
    });
    $(content).each(function () {
      $(this).removeClass("current").addClass("remove");
    });
    $(main_image).each(function () {
      $(this).removeClass("current").addClass("remove");
    });
    $(thumbnailLeft).each(function () {
      $(this).removeClass("current").addClass("remove");
    });
    $(thumbnailRight).each(function () {
      $(this).removeClass("current").addClass("remove");
    });
    $(button1).each(function () {
      $(this).removeClass("current").addClass("remove");
    });
    $(button2).each(function () {
      $(this).removeClass("current").addClass("remove");
    });
    $(button3).each(function () {
      $(this).removeClass("current").addClass("remove");
    });
    $(button4).each(function () {
      $(this).removeClass("current").addClass("remove");
    });
    $(button5).each(function () {
      $(this).removeClass("current").addClass("remove");
    });
    $(button6).each(function () {
      $(this).removeClass("current").addClass("remove");
    });

    $(title[slideIndex]).addClass("current").removeClass("remove");
    $(content[slideIndex]).addClass("current").removeClass("remove");
    $(main_image[slideIndex]).addClass("current").removeClass("remove");
    $(thumbnailLeft[leftIndex]).addClass("current").removeClass("remove");
    $(thumbnailRight[rightIndex]).addClass("current").removeClass("remove");
    $(button1[slideIndex]).addClass("current").removeClass("remove");
    $(button2[slideIndex]).addClass("current").removeClass("remove");
    $(button3[slideIndex]).addClass("current").removeClass("remove");
    $(button4[slideIndex]).addClass("current").removeClass("remove");
    $(button5[slideIndex]).addClass("current").removeClass("remove");
    $(button6[slideIndex]).addClass("current").removeClass("remove");
    $(".current").show();
    $(".remove").hide();
  }

  $(".prev").on("click", function (e) {
    e.preventDefault;
    prevSlide();
  });

  function prevSlide() {
    clearInterval(intervalId);
    slideIndex--;
    leftIndex--;
    rightIndex--;

    showSlide(slideIndex);
    showSlide(leftIndex);
    showSlide(rightIndex);
  }

  $(".next").on("click", function (e) {
    e.preventDefault;
    nextSlide();
  });

  function nextSlide() {
    slideIndex++;
    leftIndex++;
    rightIndex++;

    showSlide(slideIndex);
    showSlide(leftIndex);
    showSlide(rightIndex);
  }

  intervalId = setInterval(nextSlide, 6000);
});
