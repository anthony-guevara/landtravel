let swRegistration = null;

if ("serviceWorker" in navigator) {
  navigator.serviceWorker
    .register("sw.js")
    .then((reg) => {
      console.log("service worker registrado.");

      swRegistration = reg;

      displayNotification();
    })
    .catch((err) => console.log("service worker no registrado", err));
}

function displayNotification() {
  if (window.Notification && Notification.permission === "granted") {
    notification();
  }
  // If the user hasn't told if he wants to be notified or not
  // Note: because of Chrome, we are not sure the permission property
  // is set, therefore it's unsafe to check for the "default" value.
  else if (window.Notification && Notification.permission !== "denied") {
    Notification.requestPermission((status) => {
      if (status === "granted") {
        notification();
      } else {
        console.log("No permitiste el acceso a notificaciones.");
      }
    });
  } else {
    // If the user refuses to get notified
    console.log("No permitiste el acceso a notificaciones.");
  }
}

function notification() {
  const options = {
    body: "Para reservar, por favor inicia sesión.",
    icon: "../img/logo.png",
  };
  swRegistration.showNotification("¡Bienvenido a Landtravel!", options);
}
