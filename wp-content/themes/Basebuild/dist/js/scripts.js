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

    
    // Run the function initially
    adjustBodyPadding();
    window.onresize = adjustBodyPadding;


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


//verrtica layout

const layoutToggle = document.querySelector("#layoutToggle");
const headerRight = document.querySelector(".header-right");
const menuIcon = document.querySelector("#menuIcon");
const closeIcon = document.querySelector("#closeIcon");
const pageContainer = document.querySelector(".main-container"); // targeting the specific div


layoutToggle.addEventListener("click", function() {
  headerRight.classList.toggle("vertical-layout");
  menuIcon.style.display = menuIcon.style.display === 'none' ? 'inline' : 'none';
  closeIcon.style.display = closeIcon.style.display === 'none' ? 'inline' : 'none';

  // Toggle scrolling
  if (document.body.style.overflow !== "hidden") {
    document.body.style.overflow = "hidden";
  } else {
    document.body.style.overflow = "auto";
  }

  if (pageContainer.style.overflow !== "hidden") {
    pageContainer.style.overflow = "hidden";
    pageContainer.style.position = "fixed";

  } else {
    pageContainer.style.overflow = "auto";
    pageContainer.style.position = "relative";
  }

});


function adjustBodyPadding() {
  // Get the height of the header
  var headerHeight = document.querySelector('.header').offsetHeight;

  // Set the top padding of the body to the height of the header
  document.body.style.paddingTop = headerHeight + 'px';
}

// Update the padding when the window is resized



