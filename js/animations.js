$(document).ready(function() {
  var config = {
    // How long Waves effect duration
    // when it's clicked (in milliseconds)
    duration: 1000,

    // Delay showing Waves effect on touch
    // and hide the effect if user scrolls
    // (0 to disable delay) (in milliseconds)
    delay: 250
};
// Initialise Waves with the config
Waves.init(config);
  Waves.attach('.wave',['waves-button']);
});
