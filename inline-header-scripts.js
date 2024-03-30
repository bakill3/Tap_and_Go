      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-MBQ9YS4JX3');
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {

    // Function to set a cookie
        function setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            const expires = "expires=" + date.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/";
        }

    // Function to get a cookie
        function getCookie(name) {
            const cookieName = name + "=";
            const decodedCookie = decodeURIComponent(document.cookie);
            const ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(cookieName) == 0) {
                    return c.substring(cookieName.length, c.length);
                }
            }
            return "";
        }

    // Check if the user has visited the site before
        const visitedBefore = getCookie("visitedBefore");

        if (!visitedBefore) {
        // This is a first-time visit
            Swal.fire(
              'Website Under Construction',
              'Please note that this website is still under construction.',
              'info'
              )

        // Set the cookie to indicate the user has visited before
        setCookie("visitedBefore", "true", 7); // The cookie will last for 7 days
    }

});