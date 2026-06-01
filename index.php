<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maniniyot Studio Photography</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap');

        html {
            scroll-behavior: smooth;
        }
        :root {
            --bg-color: #ffffff;
            --text-color: #1a1a1a;
            --accent-color: #7d7d7d;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            overflow-x: hidden;
        }

        h1, h2, h3, .brand {
            font-family: 'Playfair Display', serif;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .gallery-item {
            overflow: hidden;
            position: relative;
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .gallery-item img {
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item.hidden-item {
            display: none;
            opacity: 0;
            transform: scale(0.9);
        }

.gallery-item img {
    transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform;
}

        .nav-link {
            position: relative;
            transition: color 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: var(--text-color);
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Category Tab Styling */
        .filter-btn {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .filter-btn.active {
            color: #000;
            font-weight: 600;
        }
        
        .filter-btn.active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #000;
        }

        /* Mobile Menu Transition */
        #mobileMenu {
            transition: all 0.3s ease-in-out;
            transform: translateY(-10px);
            opacity: 0;
            pointer-events: none;
        }

        #mobileMenu.active {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        /* Form styling */
        input, select, textarea {
            border-bottom: 1px solid #e5e7eb !important;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;
            border-radius: 0 !important;
            padding: 1rem 0 !important;
            background: transparent !important;
        }

        input:focus, select:focus, textarea:focus {
            outline: none !important;
            border-color: var(--text-color) !important;
            box-shadow: none !important;
        }
    </style>
</head>
<body class="antialiased">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-100 transition-all duration-300 py-4" id="mainNav">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="#" class="brand text-xl md:text-2xl font-bold tracking-tight" style="letter-spacing: 1px;">maniniyot.</a>
            
            <!-- Desktop Nav -->
            <div class="hidden md:flex space-x-10 text-sm uppercase tracking-widest font-medium">
                <a href="#home" class="nav-link">Home</a>
                <a href="#portfolio" class="nav-link">Portfolio</a>
                <a href="#services" class="nav-link">Services</a>
                <a href="#contact" class="nav-link">Contact</a>
            </div>

            <!-- Mobile Toggle -->
            <button class="md:hidden flex items-center p-2 text-black" id="menuBtn" aria-label="Toggle Menu">
                <i data-lucide="menu" id="menuIcon" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden bg-white w-full absolute top-full left-0 border-b border-gray-100 py-8 px-8 flex flex-col space-y-6 text-base uppercase tracking-widest font-medium shadow-xl">
            <a href="#home" class="mobile-link hover:pl-2 transition-all">Home</a>
            <a href="#portfolio" class="mobile-link hover:pl-2 transition-all">Portfolio</a>
            <a href="#services" class="mobile-link hover:pl-2 transition-all">Services</a>
            <a href="#contact" class="mobile-link hover:pl-2 transition-all">Contact</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center pt-24 pb-12 px-6">
        <div class="max-w-7xl w-full grid md:grid-cols-2 gap-12 items-center">
            <div class="fade-in order-2 md:order-1 visible">
                <span class="text-[10px] md:text-xs uppercase tracking-[0.3em] text-gray-400 mb-4 block">Based in Cebu, Philippines</span>
                <h1 class="text-4xl sm:text-5xl md:text-7xl mb-6 leading-tight">Preserving moments in their <span class="italic font-light text-gray-700">purest form.</span></h1>
                <p class="text-gray-500 text-sm md:text-base max-w-md mb-8 leading-relaxed">Specializing in storytelling through light and shadow. We capture the emotions that define your most precious milestones.</p>
                <a href="#contact" class="inline-block px-8 py-4 bg-black text-white text-[10px] md:text-xs uppercase tracking-widest hover:bg-gray-800 transition-colors rounded-sm">Book a Session</a>
            </div>
            <div class="relative fade-in order-1 md:order-2 visible" style="transition-delay: 0.2s;">
                <img src="imgs/birthday/arnelboy3.jpg" alt="Baby smiling" class="w-full h-[350px] md:h-[500px] object-cover rounded-sm shadow-2xl">
                <div class="absolute -bottom-4 -left-4 md:-bottom-6 md:-left-6 bg-white p-4 md:p-6 hidden sm:block shadow-lg border border-gray-50">
                    <p class="text-[10px] md:text-xs italic text-gray-600">"Art is not what you see, but what you make others see."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Gallery -->
    <section id="portfolio" class="py-16 md:py-24 px-6 bg-gray-50">
        <div class="max-w-screen-2xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 md:mb-16 gap-8">
                <div class="fade-in visible">
                    <h2 class="text-3xl md:text-4xl mb-4">The Gallery</h2>
                    <p class="text-gray-500 text-sm md:text-base">A collection of our favorite stories told through the lens.</p>
                </div>
                
                <!-- Gallery Filter Menu -->
                <div class="fade-in visible overflow-x-auto w-full md:w-auto">
                    <div class="flex space-x-6 md:space-x-8 text-[10px] md:text-xs uppercase tracking-[0.2em] text-gray-400 font-bold border-b border-gray-200 pb-2 md:pb-4 min-w-max">
                        <button class="filter-btn active" data-filter="all">All</button>
                        <button class="filter-btn" data-filter="wedding">Wedding</button>
                        <button class="filter-btn" data-filter="birthdays">Birthdays</button>
                        <button class="filter-btn" data-filter="prenup">Prenup</button>
                        <button class="filter-btn" data-filter="portrait">Portrait</button>
                        <button class="filter-btn" data-filter="other">Other</button>
                    </div>
                </div>
            </div>

            <!-- Initialized with 6 columns for "All" -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6" id="gallery-grid">
                <!-- Portrait -->
                <div class="gallery-item fade-in visible" data-category="portrait">
                    <img src="imgs/portrait/RBC08890.JPG" loading="lazy"
 decoding="async" alt="The moody window profile" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Portrait</p>
                        <h3 class="text-sm font-medium">Moody Window Profile</h3>
                    </div>
                </div>
                <!-- Birthday -->
                <div class="gallery-item fade-in visible" data-category="birthdays">
                    <img src="imgs/birthday/_MG_6398.jpg" loading="lazy"
 decoding="async" alt="Woman With Balloons" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Birthday</p>
                        <h3 class="text-sm font-medium">Birthday Pose</h3>
                    </div>
                </div>
                <!-- Portrait -->
                <div class="gallery-item fade-in visible" data-category="portrait">
                    <img src="imgs/portrait/_MG_8436-2.JPG" loading="lazy"
 decoding="async" alt="Woman on the beach" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Portrait</p>
                        <h3 class="text-sm font-medium">Beach Soul</h3>
                    </div>
                </div>
                <!-- Birthdays -->
                <div class="gallery-item fade-in visible" data-category="birthdays">
                    <img src="/imgs/birthday/_MG_8947.JPG" loading="lazy"
 decoding="async" alt="Woman with vintage car" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Birthdays</p>
                        <h3 class="text-sm font-medium">Vintage Style</h3>
                    </div>
                </div>
                <!-- Other -->
                <div class="gallery-item fade-in visible" data-category="other">
                    <img src="imgs/other/r3.jpg" loading="lazy"
 decoding="async" alt="a dog posing" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Other</p>
                        <h3 class="text-sm font-medium">The Dog</h3>
                    </div>
                </div>
                <!-- Prenup -->
                <div class="gallery-item fade-in visible" data-category="prenup">
                    <img src="imgs/prenup/s69.jpg" loading="lazy"
 decoding="async" alt="Couple in the hills" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Other</p>
                        <h3 class="text-sm font-medium">Couple in the hills</h3>
                    </div>
                </div>

                 <!-- 2 row -->
                <div class="gallery-item fade-in visible" data-category="wedding">
                    <img src="imgs//wedding/FILE138.jpg" loading="lazy"
 decoding="async" alt="Wedding portrait" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Wedding</p>
                        <h3 class="text-sm font-medium">Wedding Portrait</h3>
                    </div>
                </div>

                 
                <div class="gallery-item fade-in visible" data-category="prenup">
                    <img src="imgs/prenup/APC02198.jpg" loading="lazy"
 decoding="async" alt="Couple on the mountain overlook" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Prenup</p>
                        <h3 class="text-sm font-medium">Mountain Love</h3>
                    </div>
                </div>

                 <!-- Prenup -->
                <div class="gallery-item fade-in visible" data-category="portrait">
                    <img src="imgs/portrait/r8.jpg" loading="lazy"
 decoding="async" alt="Two women in the tall grass" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Portrait</p>
                        <h3 class="text-sm font-medium">Rusty Look</h3>
                    </div>
                </div>

                <div class="gallery-item fade-in visible" data-category="birthday">
                    <img src="imgs/birthday/_MG_8761.JPG" loading="lazy"
 decoding="async" alt="Woman in red dress by the bridge" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Birthday</p>
                        <h3 class="text-sm font-medium">Lady in Red</h3>
                    </div>
                </div>

 <!-- Prenup -->
                <div class="gallery-item fade-in visible" data-category="prenup">
                    <img src="imgs/prenup/prenup.jpg" loading="lazy"
 decoding="async" alt="Couple lying in the grass holding hands" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Other</p>
                        <h3 class="text-sm font-medium">Greener Side</h3>
                    </div>
                </div>
 <!-- Prenup -->
                <div class="gallery-item fade-in visible" data-category="prenup">
                    <img src="imgs/prenup/_MG_8127-2.JPG" loading="lazy"
 decoding="async" alt="Couple in traditional Japanese attire" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Other</p>
                        <h3 class="text-sm font-medium">Japanese Attire</h3>
                    </div>
                </div>



                <!-- Additional Bday -->
                <div class="gallery-item fade-in visible" data-category="birthdays">
                    <img src="imgs/birthday/m10.jpg" loading="lazy"
 decoding="async" alt="Moana-themed child on raft" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Birthday</p>
                        <h3 class="text-sm font-medium">Moana Themed</h3>
                    </div>
                </div>
                <!-- Additional Birthdays -->
                <div class="gallery-item fade-in visible" data-category="birthdays">
                    <img src="imgs/birthday/ballon.jpg" loading="lazy"
 decoding="async" alt="Toddler with bunch of balloons" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Birthdays</p>
                        <h3 class="text-sm font-medium">Bunch of Colors</h3>
                    </div>
                </div>
                <!-- Additional Bday -->
                <div class="gallery-item fade-in visible" data-category="birthdays">
                    <img src="imgs/birthday/_RBC1293.jpg" loading="lazy"
 decoding="async" alt="Baby in safari outfit" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Birthday</p>
                        <h3 class="text-sm font-medium">Baby in Safari</h3>
                    </div>
                </div>
                <!-- Additional bday -->
                <div class="gallery-item fade-in visible" data-category="birthdays">
                    <img src="imgs/birthday/Ps1.jpg" loading="lazy"
 decoding="async" alt="Child in blue/pink dress" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Birthday</p>
                        <h3 class="text-sm font-medium">Blue Pink</h3>
                    </div>
                </div>
                <!-- Additional Wedding -->
                <div class="gallery-item fade-in visible" data-category="prenup">
                    <img src="imgs/prenup/s58.jpg" loading="lazy"
 decoding="async"
                     alt="toddler in white gown" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Birthday</p>
                        <h3 class="text-sm font-medium">Spring Fountain</h3>
                    </div>
                </div>
                <!-- Additional Other -->
                <div class="gallery-item fade-in visible" data-category="other">
                    <img src="imgs/portrait/van7.jpg"  loading="lazy"
 decoding="async" alt="Event" class="w-full aspect-[4/5] object-cover">
                    <div class="mt-3">
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">Other</p>
                        <h3 class="text-sm font-medium">Aesthetic Pose</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-16 md:py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 md:mb-20 fade-in visible">
                <h2 class="text-3xl md:text-4xl mb-4">Our Services</h2>
                <div class="h-0.5 w-12 bg-black mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-12 md:gap-y-16">
                <div class="fade-in visible">
                    <h3 class="text-xl md:text-2xl mb-4">Weddings</h3>
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed">Full-day coverage including high-resolution digital files, professional retouching, and a luxury physical album.</p>
                </div>
                <div class="fade-in visible">
                    <h3 class="text-xl md:text-2xl mb-4">Prenup / Engagement</h3>
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed">A cinematic session focusing on your unique chemistry before the big day.</p>
                </div>
                <div class="fade-in visible">
                    <h3 class="text-xl md:text-2xl mb-4">Events</h3>
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed">Corporate galas or community gatherings. We capture the energy and the details.</p>
                </div>
               
                <div class="fade-in visible">
                    <h3 class="text-xl md:text-2xl mb-4">Birthdays</h3>
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed">From first birthdays to century celebrations. We focus on candid joy.</p>
                </div>
                <div class="fade-in visible">
                    <h3 class="text-xl md:text-2xl mb-4">Portrait Sessions</h3>
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed">Individual branding designed to showcase your authentic self.</p>
                </div>
                 <div class="fade-in visible">
                    <h3 class="text-xl md:text-2xl mb-4">Family Sessions</h3>
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed">Timeless portraits that celebrate connection, laughter, and the beauty of family at every stage of life.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 md:py-24 px-6 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 md:gap-16">
            <div class="fade-in visible">
                <h2 class="text-3xl md:text-4xl mb-6 md:mb-8">Let's Create Something <br><span class="italic font-light">Beautiful</span></h2>
                <p class="text-gray-500 text-sm md:text-base mb-8 md:mb-12">Every story is different. We'd love to hear yours.</p>
                
                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <i data-lucide="mail" class="w-4 h-4 text-gray-400"></i>
                        <span class="text-xs md:text-sm">arnelcapillanes1000@gmail.com</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i data-lucide="phone" class="w-4 h-4 text-gray-400"></i>
                        <span class="text-xs md:text-sm">+63 912 345 6789</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i data-lucide="instagram" class="w-4 h-4 text-gray-400"></i>
                        <span class="text-xs md:text-sm">@maniniyot_studio</span>
                    </div>
                </div>
            </div>

            <div class="fade-in visible mt-8 md:mt-0">
                <form id="inquiryForm" class="space-y-6" method="POST">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <input type="text" name="fullname" required class="w-full text-sm" placeholder="Full Name">
                        <input type="email" name="email" required class="w-full text-sm" placeholder="Email Address">
                    </div>
                    <select name="service" class="w-full appearance-none text-sm text-gray-500">
                        <option value="">Select Service</option>
                        <option value="wedding">Wedding</option>
                        <option value="birthdays">Birthdays</option>
                        <option value="prenup">Prenup</option>
                        <option value="portrait">Portrait</option>
                        <option value="other">Other</option>
                    </select>
                    <textarea required class="w-full h-24 md:h-32 resize-none text-sm" name="message" placeholder="Tell us about your event..."></textarea>
                  <button id="submitBtn" type="submit" class="bg-black text-white px-4 py-2">Send Message</button>
                 <div id="formStatus" class="opacity-0 transition-all duration-500 transform translate-y-2 text-sm px-4 py-3 rounded-md shadow-sm font-medium"></div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 px-6 border-t border-gray-100 text-center">
        <div class="max-w-7xl mx-auto flex flex-col items-center">
            <span class="brand text-xl font-bold mb-6 tracking-widest">maniniyot.</span>
            <p class="text-[9px] md:text-[10px] uppercase tracking-[0.4em] text-gray-400">© 2026 Developed By <a href="https://gleeong.com" style="color:#1a73e8;text-decoration:underline;">Georgie Lee</a> </p>
        </div>
    </footer>

 <script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("inquiryForm");
    const statusDiv = document.getElementById("formStatus");
    const button = document.getElementById("submitBtn");

    form.addEventListener("submit", function(e) {
        e.preventDefault();

        let formData = new FormData(form);

        // 🔒 Disable button subtly
        button.disabled = true;
        button.classList.add("opacity-50", "cursor-not-allowed");

        fetch("send.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {

            // Reset + base styling
            statusDiv.className = "opacity-0 transition-all duration-500 transform translate-y-2 text-sm px-4 py-3 rounded-md shadow-sm font-medium";

            // Add icon + message
            if (data.toLowerCase().includes("success")) {
                statusDiv.innerHTML = "✓ " + data;
                statusDiv.classList.add(
                    "bg-green-50",
                    "text-green-700",
                    "border-l-4",
                    "border-green-500"
                );
                form.reset();
            } else {
                statusDiv.innerHTML = "⚠ " + data;
                statusDiv.classList.add(
                    "bg-red-50",
                    "text-red-700",
                    "border-l-4",
                    "border-red-500"
                );
            }

            // 🌿 Animate in (fade + slight slide)
            setTimeout(() => {
                statusDiv.classList.remove("opacity-0", "translate-y-2");
                statusDiv.classList.add("opacity-100", "translate-y-0");
            }, 50);

            // ⏲ Auto hide after 5s
            setTimeout(() => {
                statusDiv.classList.remove("opacity-100", "translate-y-0");
                statusDiv.classList.add("opacity-0", "translate-y-2");
            }, 5000);
        })
        .catch(() => {
            // Error fallback styling
            statusDiv.className = "opacity-100 text-sm px-4 py-3 rounded-md shadow-sm font-medium bg-red-50 text-red-700 border-l-4 border-red-500";
            statusDiv.innerHTML = "⚠ Something went wrong. Please try again.";
        })
        .finally(() => {
            // 🔓 Re-enable button
            button.disabled = false;
            button.classList.remove("opacity-50", "cursor-not-allowed");
        });
    });
});
</script>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Scroll Reveal Animation
        const observerOptions = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);
        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

        // Gallery Filtering Logic
        const filterBtns = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');
        const galleryGrid = document.getElementById('gallery-grid');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active state
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.getAttribute('data-filter');

                // Toggle Grid Columns
                if (filter === 'all') {
                    // 6 columns for desktop, 4 for tablet, 2 for mobile
                    galleryGrid.className = 'grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6';
                } else {
                    // 3 columns for desktop, 2 for tablet, 1 for mobile
                    galleryGrid.className = 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8';
                }

                galleryItems.forEach(item => {
                    const category = item.getAttribute('data-category');
                    
                    if (filter === 'all' || filter === category) {
                        item.classList.remove('hidden-item');
                        // Small delay to trigger transition
                        requestAnimationFrame(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        });
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.9)';
                        // Wait for transition before hiding
                        setTimeout(() => {
                            if (item.style.opacity === '0') {
                                item.classList.add('hidden-item');
                            }
                        }, 400);
                    }
                });
            });
        });

        // Mobile Menu Logic
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        
        menuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isActive = mobileMenu.classList.toggle('active');
            mobileMenu.classList.toggle('hidden');
            if (isActive) {
                menuIcon.innerHTML = lucide.icons['x'].toSvg({ class: 'w-6 h-6' });
            } else {
                menuIcon.innerHTML = lucide.icons['menu'].toSvg({ class: 'w-6 h-6' });
            }
        });

        // Close menu on click outside
        document.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !menuBtn.contains(e.target)) {
                mobileMenu.classList.remove('active');
                mobileMenu.classList.add('hidden');
                menuIcon.innerHTML = lucide.icons['menu'].toSvg({ class: 'w-6 h-6' });
            }
        });

        // Form Handling
        const form = document.getElementById('inquiryForm');
        const status = document.getElementById('formStatus');

        form.addEventListener('submit', () => {
            const btn = form.querySelector('button');
            btn.disabled = true;
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 20) {
                nav.classList.add('py-2', 'shadow-sm');
                nav.classList.remove('py-4');
            } else {
                nav.classList.add('py-4');
                nav.classList.remove('py-2', 'shadow-sm');
            }
        });
    </script>
</body>
</html>