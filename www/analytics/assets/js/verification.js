$(document).ready(function () {
  $("#password").on("keyup", function () {
    var password = $(this).val();
    var strength = 0;
    if (password.length >= 8) {
      strength++;
    }
    if (password.match(/[A-Z]/)) {
      strength++;
    }
    if (password.match(/\d/)) {
      strength++;
    }
    if (password.match(/[\W_]/)) {
      strength++;
    }
    var bar_width = (strength / 4) * 100;
    $(".password-meter-bar").css("width", bar_width + "%");
    if (strength < 2) {
      $(".password-meter-bar").css("background-color", "#f00");
      $(".password-meter-text").text("Weak");
    } else if (strength < 4) {
      $(".password-meter-bar").css("background-color", "orange");
      $(".password-meter-text").text("Safe");
    } else {
      $(".password-meter-bar").css("background-color", "#0f0");
      $(".password-meter-text").text("Strong");
    }
  });
});
