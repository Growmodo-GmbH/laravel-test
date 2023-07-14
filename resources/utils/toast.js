export default function toast(message, type = 'success') {
    let backgroundColor;
    switch (type) {
        case 'error':
            backgroundColor = "linear-gradient(to right, #ff5f6d, #ffc371)";
            break;
        case 'success':
            backgroundColor = "linear-gradient(to right, #00b09b, #96c93d)";
            break;
        case 'info':
            backgroundColor = "linear-gradient(to right, #2193b0, #6dd5ed)";
            break;
        case 'warning':
            backgroundColor = "linear-gradient(to right, #f12711, #f5af19)";
            break;
        default:
            backgroundColor = "linear-gradient(to right, #00b09b, #96c93d)";
    }

    Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor,
    }).showToast();
}
