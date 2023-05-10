// function setPaddingTop() {
//   var menu = document.querySelector('.fixed-menu');
//   var content = document.querySelector('body');

//   if (menu && content) {
//     var menuHeight = menu.offsetHeight;
//     content.style.paddingTop = menuHeight + 'px';
//   } else {
//     console.error('Either .fixed-menu or body element not found.');
//   }
// }
  
//   window.addEventListener('load', setPaddingTop);
//   window.addEventListener('resize', setPaddingTop);
  
  document.addEventListener("DOMContentLoaded", function() {
    const postGrid = document.getElementById("posts-grid");

    if (postGrid) {
      const postItems = postGrid.querySelectorAll(".post-item");

      // First row
      postItems[0].style.gridColumn = "span 2";
      postItems[1].style.gridColumn = "span 1";
      postItems[2].style.gridColumn = "span 1";


      // Second row
      postItems[3].style.gridColumn = "span 2";

      // Third row
      postItems[4].style.gridColumn = "span 3";
      postItems[5].style.gridColumn = "span 1";
      postItems[6].style.gridColumn = "span 2";


      // Randomly assign grid span for the remaining posts
      for (let i = 7; i < postItems.length; i++) {
          postItems[i].style.gridColumn = "span " + (Math.random() < 0.5 ? 1 : 2);
      }

    }

});

//gallery 

document.addEventListener('DOMContentLoaded', function() {
  const gallery = document.querySelector('.slick-gallery');

  if (gallery) {
    jQuery('.slick-gallery').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: true,
      arrows: false,
      infinite: false,
      adaptiveHeight: false,
      variableWidth: true, // Add this line
      customPaging: function(slider, i) {
        return '<div class="slick-dot"></div>';
      },
    });
  } else {
    console.error('Gallery element not found.');
  }
});


//scroll








