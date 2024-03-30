<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Instagram Comment Picker and Giveaways Tool - WASK V2</title>
    <link rel="icon" type="image/x-icon" href="https://www.wask.co/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #E0E0E0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #fce3ec, #f9d6e4, #f0c6e0, #e0b8dc, #d1a8d5, #c29bce, #b48ec6, #a782bd, #9975b4, #8c67aa, #805aa0, #744c95);
            background-size: 200% 200%;
            animation: gradientAnimation 10s ease infinite;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .card {
            background-color: #ffffffdd; /* Semi-transparent white */
            backdrop-filter: blur(10px); /* Blur effect for the background */
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-primary {
            background-image: linear-gradient(45deg, #ff758c 0%, #ff7eb3 100%);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: bold;
            color: white;
            border-radius: 50px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        .btn-primary:hover {
            transform: scale(1.05);
        }
        #winnerDisplay {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen">
    <div class="text-center card" style="margin:10%;">
        <h1 class="text-4xl font-bold mb-4">Instagram Giveaway</h1>
        <p class="mb-6">Press start to find the lucky winner!</p>

        <div id="winnerDisplay" class="p-4 mb-4 rounded-lg text-black">Winner will be displayed here...</div>
        <input type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="https://www.instagram.com/p/C3acLcmorHP/" required style="width: 70%; margin: 0 auto; display: inline-block;" />
        <button id="startButton" class="btn-primary" style="display: inline-block;">Start</button>
    </div>

    <script src="winnerSelection.js"></script>
</body>
</html>
