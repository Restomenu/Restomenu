import Echo from "laravel-echo";
window.io = require("socket.io-client");

// window.Echo = new Echo({
//     broadcaster: "socket.io",
//     host: window.location.hostname + ":6001" // this is laravel-echo-server host
// });

// Have this in case you stop running your laravel echo server
if (typeof io !== "undefined") {
    window.Echo = new Echo({
        broadcaster: "socket.io",
        host: window.location.hostname  // this is laravel-echo-server host
        // host: window.location.hostname + ":6001" // this is laravel-echo-server host
    });
}
