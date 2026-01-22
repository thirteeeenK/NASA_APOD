<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astronomy Picture of the Day</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        space: {
                            900: '#0b0d17',
                            800: '#151932',
                            700: '#1e2448',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-image: radial-gradient(circle at center, #1e2448 0%, #0b0d17 100%);
            min-height: 100vh;
        }
    </style>
</head>

<body class="text-white antialiased flex flex-col items-center justify-center p-4 sm:p-8">

    <div class="w-full max-w-4xl bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl overflow-hidden p-6 md:p-10 relative">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-purple-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>

        <header class="text-center mb-10 relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-200 to-purple-200 mb-2">Astronomy Picture of The Day</h1>
            <div class="h-1 w-24 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
        </header>

        <main class="grid md:grid-cols-2 gap-8 items-start relative z-10">
            <!-- Image Section -->
            <div class="group relative rounded-2xl overflow-hidden shadow-lg border border-white/5 bg-black/20 min-h-[300px] flex items-center justify-center">
                <div id="loader" class="absolute inset-0 flex items-center justify-center text-blue-200">
                    <svg class="animate-spin h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <img id="image" src="" alt="APOD" class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105 opacity-0 duration-500" onload="this.classList.remove('opacity-0'); document.getElementById('loader').classList.add('hidden')">
            </div>

            <!-- Content Section -->
            <div class="space-y-6">
                <div>
                    <span id="date" class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-200 border border-blue-500/30 mb-3">Loading date...</span>
                    <h2 id="title" class="text-3xl font-bold leading-tight text-white mb-4">Loading Title...</h2>
                    <p id="explanation" class="text-gray-300 leading-relaxed text-sm md:text-base">Please wait while we fetch the latest astronomy picture from NASA.</p>
                </div>
            </div>
        </main>
        
        <footer class="mt-12 text-center text-xs text-gray-500 relative z-10">
            <p>Powered by NASA Open API</p>
        </footer>
    </div>

    <script>
        // Fetch data from our local backend proxy
        fetch("api.php")
            .then(res => res.json())
            .then(data => { 
                if(data.error) {
                    throw new Error(data.error);
                }
                
                document.getElementById("title").innerText = data.title;
                document.getElementById("date").innerText = data.date;
                document.getElementById("explanation").innerText = data.explanation;
                
                if(data.media_type === "image") {
                    document.getElementById("image").src = data.hdurl || data.url;
                } else {
                    // Fallback for video or other media types
                    document.getElementById("image").parentElement.innerHTML = '<iframe src="' + data.url + '" class="w-full aspect-video rounded-2xl" frameborder="0" allowfullscreen></iframe>';
                }
            })
            .catch(err => {
                console.error("Error Fetching Data:", err);
                document.getElementById("title").innerText = "Error Loading Data";
                document.getElementById("explanation").innerText = "Failed to fetch astronomy picture. Please try again later.";
                document.getElementById("date").innerText = new Date().toISOString().split('T')[0];
                document.getElementById("loader").innerHTML = '<span class="text-red-400">Error</span>';
            });
    </script>
</body>

</html>