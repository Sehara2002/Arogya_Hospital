const navClassAdder = (number) => {
  switch (number) {
    case 1:
      document.getElementById("link1").classList.add("active");
      document.getElementById("link2").classList.remove("active");
      document.getElementById("link3").classList.remove("active");
      document.getElementById("link4").classList.remove("active");
      console.log("Added to link1");
      break;
    case 2:
        document.getElementById("link1").classList.remove("active");
        document.getElementById("link2").classList.add("active");
        document.getElementById("link3").classList.remove("active");
        document.getElementById("link4").classList.remove("active");
      console.log("Added to link2");
      break;
    case 3:
        document.getElementById("link1").classList.remove("active");
        document.getElementById("link2").classList.remove("active");
        document.getElementById("link3").classList.add("active");
        document.getElementById("link4").classList.remove("active");
      console.log("Added to link3");
      break;
    case 4:
        document.getElementById("link1").classList.remove("active");
        document.getElementById("link2").classList.remove("active");
        document.getElementById("link3").classList.remove("active");
        document.getElementById("link4").classList.add("active");
      console.log("Added to link4");

      break;
  }
};


const makeVisible = () => {
        document.getElementById("hidden-menu").classList.add("show");
        document.getElementById("hidden-menu").classList.remove("hide");
}
const hideVisible =() =>{
  document.getElementById("hidden-menu").classList.add("hide");
  document.getElementById("hidden-menu").classList.remove("show");
}
        
    
