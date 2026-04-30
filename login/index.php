<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Maniniyot Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .brand {
            font-family: 'Playfair Display', serif;
        }

        .login-card {
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        input {
            border-bottom: 1px solid #e5e7eb !important;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;
            border-radius: 0 !important;
            padding: 1rem 0 !important;
            background: transparent !important;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none !important;
            border-color: #000 !important;
            padding-left: 0.5rem !important;
        }

        .image-overlay {
            background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.6));
        }
    </style>
</head>
<body class="bg-white min-h-screen flex overflow-hidden">

    <!-- Left Side: Visual -->
    <div class="hidden lg:block w-1/2 relative overflow-hidden">
        <img src="../imgs/all/DJI_0372.jpg" 
             alt="Camera" 
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 image-overlay flex flex-col justify-end p-20 text-white">
            <h1 class="brand text-5xl mb-4">Focus on the <span class="italic">moment.</span></h1>
            <p class="text-sm uppercase tracking-[0.4em] opacity-80 font-light">The Administrator Portal</p>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 md:p-24 bg-gray-50/30">
        <div class="max-w-md w-full login-card">
            <div class="mb-12">
                <a href="https://maniniyot.gleeong.com/" class="brand text-2xl font-bold tracking-tighter mb-8 block" style="letter-spacing: 0.5px;">MANINIYOT.</a>
                <h2 class="text-3xl font-medium text-gray-900 mb-2">Welcome Back</h2>
                <p class="text-gray-500 text-sm">Please enter your secure access code to manage your studio.</p>
            </div>

            <form id="loginForm" class="space-y-10">
                <div class="relative">
                    <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold block mb-1">Administrator Access Code</label>
                    <input type="password" 
                           id="password" 
                           required 
                           class="w-full text-lg tracking-widest" 
                           placeholder="••••••••">
                    <p id="errorMessage" class="hidden text-red-500 text-xs mt-4 font-medium italic">
                        The access code provided is incorrect. Please try again.
                    </p>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="w-full py-5 bg-black text-white text-xs uppercase tracking-[0.3em] font-bold hover:bg-gray-800 transition-all duration-300 flex items-center justify-center group">
                        <span>Authenticate</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>

            <div class="mt-20 border-t border-gray-100 pt-8 flex justify-between items-center">
                <a href="https://maniniyot.gleeong.com/#portfolio" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-black transition-colors font-bold">
                    ← Back to Portfolio
                </a>
                <span class="text-[10px] text-gray-300 font-medium italic"></span>
            </div>
        </div>
    </div>

   <script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const pass = document.getElementById('password').value;
    const error = document.getElementById('errorMessage');

    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'code=' + encodeURIComponent(pass)
    })
    .then(res => res.text())
    .then(data => {
        if (data === "success") {
            // ✅ Store session flag (optional frontend)
            localStorage.setItem('capture_admin_auth', 'true');

            // Redirect to admin dashboard
            window.location.href = '../dashboard';
        } else {
            showError();
        }
    })
    .catch(() => {
        showError();
    });

    function showError() {
        error.classList.remove('hidden');

        const card = document.querySelector('.login-card');
        card.classList.add('animate-bounce');
        setTimeout(() => card.classList.remove('animate-bounce'), 500);
    }
});
</script>
</body>
</html>