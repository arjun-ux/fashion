<html>
<head>
    <title>Account Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-image: url('https://placehold.co/1920x1080?text=Background+Image');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-900 bg-opacity-75">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-center text-2xl font-bold mb-6">ACCOUNT LOGIN</h2>
        <form>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    <i class="fas fa-user mr-2"></i> User name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="User name">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    <i class="fas fa-lock mr-2"></i> Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Password">
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    LOGIN
                </button>
            </div>
        </form>
    </div>
</body>
</html>