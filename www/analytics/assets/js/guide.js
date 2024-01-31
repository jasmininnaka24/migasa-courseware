let toggle = (e) => {
  let hover_show = document.querySelector(".hover_show");
  let assistant_show = document.querySelector(".assistant_show");
  let message1 = document.querySelector(".message1");
  let message2 = document.querySelector(".message2");
  let message3 = document.querySelector(".message3");
  let message4 = document.querySelector(".message4");
  let message5 = document.querySelector(".message5");
  let message6 = document.querySelector(".message6");
  let overlay = document.querySelector(".overlay");
  let audio = document.querySelector(".audio");
  let add_course = document.querySelector(".add_course");
  let see_course = document.querySelector(".see_courses");
  let upload_vids = document.querySelector(".upload_vids");
  let see_videos = document.querySelector(".see_videos");
  let manual = document.querySelector(".manual");
  let admin_prof = document.querySelector(".admin_prof");

  // hover_show.classList.toggle("hidden");
  assistant_show.classList.toggle("hidden");
  assistant_show.classList.toggle("animateInfinite");
  overlay.classList.toggle("hidden");

  setTimeout(() => {
    message1.classList.toggle("hidden");
  }, 0500);

  setTimeout(() => {
    message1.classList.toggle("hidden");
    message2.classList.toggle("hidden");
  }, 8050);

  setTimeout(() => {
    message2.classList.toggle("hidden");
    message3.classList.toggle("hidden");
    add_course.setAttribute("style", "z-index: 400; padding: 10px;");
  }, 15000);

  setTimeout(() => {
    message3.classList.toggle("hidden");
    message4.classList.toggle("hidden");
    add_course.removeAttribute("style");
    see_course.setAttribute("style", "z-index: 400; padding: 10px;");
  }, 33000);

  setTimeout(() => {
    message4.classList.toggle("hidden");
    message5.classList.toggle("hidden");
    see_course.removeAttribute("style");
    manual.setAttribute("style", "z-index: 400; padding: 10px;");
  }, 45000);

  setTimeout(() => {
    message5.classList.toggle("hidden");
    message6.classList.toggle("hidden");
    manual.removeAttribute("style");
    admin_prof.setAttribute("style", "z-index: 400; padding: 10px;");
  }, 62200);

  setTimeout(() => {
    message6.classList.toggle("hidden");
    assistant_show.classList.toggle("hidden");
    assistant_show.classList.toggle("animateInfinite");
    overlay.classList.toggle("hidden");
    admin_prof.removeAttribute("style");
  }, 77200);

  if (audio.paused) {
    audio.play();
    audioBtn.innerText = "Pause Audio";
  } else {
    audio.pause();
    audioBtn.innerText = "Play Audio";
  }
};

let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
    arrowParent.classList.toggle("showMenu");
  });
}
