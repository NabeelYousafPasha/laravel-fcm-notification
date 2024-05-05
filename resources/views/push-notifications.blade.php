<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FCM Token</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body class="antialiased" onload="requestNotificationPermission()">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('FCM Token in Console') }}</div>

                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js"></script>
    <script>
        function requestNotificationPermission() {
            const firebaseConfig = {
                apiKey: "AIzaSyDj9PwfdC5WlXu4P9fYML2uyiblvzWXktM",
                authDomain: "pay4money-5e66d.firebaseapp.com",
                projectId: "pay4money-5e66d",
                storageBucket: "pay4money-5e66d.appspot.com",
                messagingSenderId: "923706469457",
                appId: "1:923706469457:web:eb8d1cdaef61f747f2dc70",
                measurementId: "G-9FXF8EJH4K"
            };

            firebase.initializeApp(firebaseConfig);
            const messaging = firebase.messaging();

            // Request permission for notifications
            messaging.requestPermission()
                .then(() => {
                    messaging.getToken({
                            vapidKey: 'BOue-tn3ekm88feUa3Gaz_RAcNlbBffo4jqPpfxVXjGIqoN1UvKFRSNl1HTgLosmdckWRCgCdBX3RqWEe1lIXRM'
                        })
                        .then((currentToken) => {
                            if (currentToken) {
                                alert(currentToken)
                                console.log('Device Token:', currentToken);
                            } else {
                                console.log('No registration token available.');
                            }
                        })
                        .catch((err) => {
                            console.error('An error occurred while retrieving token. ', err);
                        });
                })
                .catch((err) => {
                    console.error('Unable to get permission for notifications.', err);
                });
        }

    </script>
</body>
</html>
