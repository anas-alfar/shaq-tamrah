$(function () {


  /* ==================================================================
   Vertical Tab Demo 
   ================================================================== */

  $("#example-vertical").steps ({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    stepsOrientation: "vertical",
    onInit: function (event, currentIndex) {
      var el = $(event.currentTarget)

      el.find ('.steps li').each (function (i) {
        $(this).find (".number").text (i+1)
      })
    }
  })
	
})