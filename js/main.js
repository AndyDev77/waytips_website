function scrollUp() {
  const scrollUp = document.querySelector(".scroll-up");
  // Lorsque le défilement est supérieur à la hauteur de 200 viewport, ajoutez la classe show-scroll à la balise a avec la classe scroll-top
  if (this.scrollY >= 200) scrollUp.classList.add("show-scroll");
  else scrollUp.classList.remove("show-scroll");
}
window.addEventListener("scroll", scrollUp);

$(".services-carousel").owlCarousel({
  loop: true,
  margin: 0,
  autoplay: true,
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
    },
    600: {
      items: 2,
    },
    1000: {
      items: 3,
    },
  },
});

const multiStepForm = document.querySelector("[data-multi-step]");
const formSteps = [...multiStepForm.querySelectorAll("[data-step]")];

let currentStep = formSteps.findIndex((step) => {
  return step.classList.contains("active");
});

if (currentStep < 0) {
  currentStep = 0;
  showCurrentStep();
}

multiStepForm.addEventListener("click", (e) => {
  let incrementor;
  if (e.target.matches("[data-next]")) {
    incrementor = 1;
  } else if (e.target.matches("[data-previous]")) {
    incrementor -= 1;
  }

  if (incrementor == null) return;

  const inputs = [...formSteps[currentStep].querySelectorAll("input")];
  const allValid = inputs.every((input) => input.checkValidity());
  console.log(allValid);
  if (allValid) {
    currentStep += incrementor;
    showCurrentStep();
  }
});

function showCurrentStep() {
  formSteps.forEach((step, index) => {
    step.classList.toggle("active", index === currentStep);
  });
}
