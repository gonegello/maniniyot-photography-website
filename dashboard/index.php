<?php include '../login/check_auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maniniyot Studio | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap');
        
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }
        .brand { font-family: 'Playfair Display', serif; }
        
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
        }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }

        input, select, textarea {
            border: 1px solid #e5e7eb !important;
            border-radius: 4px !important;
            padding: 0.75rem !important;
            width: 100%;
            font-size: 0.875rem;
            background-color: #fff !important;
            color: #000 !important;
        }

        input:focus, select:focus, textarea:focus {
            outline: none !important;
            border-color: #000 !important;
            box-shadow: 0 0 0 2px rgba(0,0,0,0.05) !important;
        }

        /* Calendar Styles */
        .calendar-day {
            aspect-ratio: 1 / 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }
        .calendar-day:hover:not(.empty) {
            background-color: #f9fafb;
        }
        .calendar-day.today {
            font-weight: 700;
            color: #000;
            background-color: #f3f4f6;
        }
        .has-booking::after {
            content: '';
            position: absolute;
            bottom: 8px;
            width: 5px;
            height: 5px;
            background-color: #000;
            border-radius: 50%;
        }
        .selected-day {
            outline: 2px solid #000;
            outline-offset: -2px;
            background-color: #f9fafb;
        }
      /* Status Colors for Calendar Days */
.bg-status-pending {
    background-color: #ffedd5 !important; /* Soft Orange */
    color: #9a3412 !important;
}

.bg-status-confirmed {
    background-color: #dbeafe !important; /* Soft Blue */
    color: #1e40af !important;
}

.bg-status-completed {
    background-color: #dcfce7 !important; /* Soft Green */
    color: #166534 !important;
}

/* Ensure the little "booking dot" matches the text color */
.has-booking.bg-status-pending::after,
.has-booking.bg-status-confirmed::after,
.has-booking.bg-status-completed::after {
    background-color: currentColor;
}

        .nav-btn { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-[#fafafa] min-h-screen">

    <!-- MAIN DASHBOARD -->
    <div id="dashboard-container" class="flex min-h-screen">
        <!-- Sidebar Navigation -->
        <aside class="fixed left-0 top-0 h-full w-20 bg-white border-r border-gray-100 flex flex-col items-center py-8 z-30 transition-all hover:w-64 group">
            <div class="brand text-2xl font-bold mb-12 tracking-tighter group-hover:hidden">M.</div>
            <div class="brand text-2xl font-bold mb-12 tracking-tighter hidden group-hover:block px-6 w-full text-left text-black">Maniniyot.</div>
            
            <nav class="flex-1 flex flex-col gap-4 w-full px-4">
                <button onclick="switchView('bookings')" id="nav-bookings" class="nav-btn flex items-center gap-4 p-3 bg-black text-white rounded-md w-full justify-center group-hover:justify-start">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>
                    <span class="hidden group-hover:block text-xs uppercase tracking-widest font-bold">Bookings</span>
                </button>
                <button onclick="switchView('schedule')" id="nav-schedule" class="nav-btn flex items-center gap-4 p-3 text-gray-400 hover:text-black hover:bg-gray-50 rounded-md w-full justify-center group-hover:justify-start">
                    <i data-lucide="calendar" class="w-5 h-5 shrink-0"></i>
                    <span class="hidden group-hover:block text-xs uppercase tracking-widest font-bold">Schedule</span>
                </button>
                <button class="nav-btn flex items-center gap-4 p-3 text-gray-400 hover:text-black hover:bg-gray-50 rounded-md w-full justify-center group-hover:justify-start">
                    <i data-lucide="settings" class="w-5 h-5 shrink-0"></i>
                    <span class="hidden group-hover:block text-xs uppercase tracking-widest font-bold">Settings</span>
                </button>
            </nav>

           <a href="logout.php" 
   class="flex items-center gap-4 p-3 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-md w-full justify-center group-hover:justify-start transition-all px-4 mx-4">
    <i data-lucide="log-out" class="w-5 h-5 shrink-0"></i>
    <span class="hidden group-hover:block text-xs uppercase tracking-widest font-bold">Exit</span>
</a>
        </aside>

        <!-- Main Content Area -->
        <main class="ml-20 flex-1 p-6 md:p-12 lg:p-16">
            <div class="max-w-7xl mx-auto">
                
                <!-- VIEW: BOOKINGS -->
                <div id="view-bookings">
                    <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                        <div>
                            <h1 class="text-4xl brand font-bold text-gray-900 mb-2">Studio Manager</h1>
                            <p class="text-gray-400 text-sm">Review your inquiries and add manual bookings below.</p>
                        </div>
                        <button id="addBookingBtn" onclick="openNewBookingModal()" class="flex items-center justify-center gap-2 bg-black text-white px-6 py-4 rounded-sm text-xs uppercase tracking-widest font-bold hover:bg-gray-800 transition shadow-lg shadow-black/10 active:scale-95">
                            <i data-lucide="plus" class="w-4 h-4"></i>Add New Booking</button>
                    </header>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                        <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-sm">
                            <p class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2">Total Revenue</p>
                            <p id="stat-revenue" class="text-2xl font-medium text-black">₱0.00</p>
                        </div>
                        <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-sm">
    <p class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2">Today's Shoots</p>
    <p id="stat-total" class="text-2xl font-medium text-black">0</p>
</div>
                        <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-sm">
                            <p class="text-[10px] uppercase tracking-widest font-bold text-orange-400 mb-2">Pending</p>
                            <p id="stat-pending" class="text-2xl font-medium text-black">0</p>
                        </div>
                        <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-sm">
                            <p class="text-[10px] uppercase tracking-widest font-bold text-green-400 mb-2">Confirmed</p>
                            <p id="stat-confirmed" class="text-2xl font-medium text-black">0</p>
                        </div>
                    </div>

                    <!-- Booking Table -->
                    <div class="bg-white border border-gray-100 shadow-sm rounded-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between">
                            <h2 class="text-xs uppercase tracking-[0.2em] font-bold text-gray-400">Booking Records</h2>
                            <div class="flex items-center gap-2 text-[10px] uppercase font-bold tracking-widest text-green-500">
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                Live Sync
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto custom-scrollbar">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="bg-gray-50/50 text-[10px] uppercase tracking-widest text-gray-400 font-bold border-b border-gray-100">
                                        <th class="px-6 py-4">Client Details</th>
                                        <th class="px-6 py-4">Email Address</th>
                                        <th class="px-6 py-4">Contact</th>
                                        <th class="px-6 py-4">Location</th>
                                        <th class="px-6 py-4">Service</th>
                                        <th class="px-6 py-4">Shoot Date</th>
                                        <th class="px-6 py-4">Price</th>
                                        <th class="px-6 py-4">Booking Notes</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="bookings-tbody" class="divide-y divide-gray-50">
                                    <tr>
                                        <td colspan="7" class="px-6 py-20 text-center text-black">
                                            <p class="text-xs uppercase tracking-widest font-bold text-gray-300">Synchronizing Database...</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- VIEW: SCHEDULE -->
                <div id="view-schedule" class="hidden">
                    <header class="mb-12">
                        <h1 class="text-4xl brand font-bold text-gray-900 mb-2">Shoot Schedule</h1>
                        <p class="text-gray-400 text-sm">Monitor your upcoming sessions and monthly availability.</p>
                    </header>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Calendar -->
                        <div class="lg:col-span-2 bg-white border border-gray-100 shadow-sm p-8 rounded-sm">
                            <div class="flex items-center justify-between mb-8">
                                <h2 id="calendar-month-year" class="text-xl font-bold tracking-tight text-black">Month Year</h2>
                                <div class="flex gap-2">
                                    <button onclick="changeMonth(-1)" class="p-2 hover:bg-gray-50 rounded-full border border-gray-100 transition text-black"><i data-lucide="chevron-left" class="w-4 h-4"></i></button>
                                    <button onclick="changeMonth(1)" class="p-2 hover:bg-gray-50 rounded-full border border-gray-100 transition text-black"><i data-lucide="chevron-right" class="w-4 h-4"></i></button>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-7 mb-4">
                                <div class="text-center text-[10px] uppercase tracking-widest font-bold text-gray-400 py-2">Sun</div>
                                <div class="text-center text-[10px] uppercase tracking-widest font-bold text-gray-400 py-2">Mon</div>
                                <div class="text-center text-[10px] uppercase tracking-widest font-bold text-gray-400 py-2">Tue</div>
                                <div class="text-center text-[10px] uppercase tracking-widest font-bold text-gray-400 py-2">Wed</div>
                                <div class="text-center text-[10px] uppercase tracking-widest font-bold text-gray-400 py-2">Thu</div>
                                <div class="text-center text-[10px] uppercase tracking-widest font-bold text-gray-400 py-2">Fri</div>
                                <div class="text-center text-[10px] uppercase tracking-widest font-bold text-gray-400 py-2">Sat</div>
                            </div>

                            <div id="calendar-grid" class="grid grid-cols-7 border-t border-l border-gray-50">
                                <!-- Generated Days -->
                            </div>
                        </div>

                        <!-- Agenda Details -->
                        <div class="bg-white border border-gray-100 shadow-sm p-8 rounded-sm">
                            <div class="mb-8 pb-4 border-b border-gray-50">
                                <h3 id="selected-date-title" class="text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-1">Select a Date</h3>
                                <p class="text-lg font-bold brand text-black">Booked Sessions</p>
                            </div>
                            <div id="day-details-list" class="space-y-4 text-black">
                                <div class="flex flex-col items-center text-center py-12 opacity-30">
                                    <i data-lucide="calendar-days" class="w-8 h-8 mb-4"></i>
                                    <p class="text-xs font-medium uppercase tracking-widest">Select a marked date</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- ADD BOOKING MODAL -->
    <div id="bookingModal" class="hidden fixed inset-0 z-[110] flex items-center justify-center p-4">
        <div class="modal-overlay absolute inset-0" onclick="toggleModal(false)"></div>
        <div class="bg-white w-full max-w-2xl rounded-sm shadow-2xl relative z-10 flex flex-col max-h-[90vh]">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h2 class="brand text-2xl font-bold text-black">New Booking Entry</h2>
                <button onclick="toggleModal(false)" class="p-2 hover:bg-gray-100 rounded-full transition text-black">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <form id="bookingForm" class="p-6 overflow-y-auto custom-scrollbar space-y-6" method="POST">
                <input type="hidden" id="booking_id" name="id" value="">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Full Name</label>
                        <input type="text" name="fullname" required placeholder="Full Name" class="text-black">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Contact Number</label>
                        <input type="tel" name="contact_number" required placeholder="09XX XXX XXXX" class="text-black">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Email Address</label>
                        <input type="email" name="email_address" required placeholder="client@email.com" class="text-black">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Address / Location</label>
                        <input type="text" name="location" required placeholder="Event Location" class="text-black">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Service Type</label>
                        <select name="service_type" required class="text-black">
                            <option value="Wedding">Wedding</option>
                            <option value="Birthdays">Birthday</option>
                            <option value="Prenup">Prenup</option>
                            <option value="Portrait">Portrait</option>
                            <option value="Event">Event</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Initial Status</label>
                        <select name="status" required class="text-black">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Shoot Date</label>
                        <input type="date" name="shoot_date" required class="text-black">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Agreed Price (₱)</label>
                        <input type="number" name="agreed_price" required placeholder="0.00" step="1" class="text-black">
                    </div>
                </div>

                <div class="space-y-1 text-black">
                    <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Booking Notes</label>
                    <textarea name="booking_notes" class="h-24 resize-none" placeholder="Special requests, themes, or additional gear..."></textarea>
                </div>

                <div class="pt-4 flex gap-4">
                    <button type="button" onclick="toggleModal(false)" class="flex-1 py-4 text-xs uppercase tracking-widest font-bold border border-gray-100 hover:bg-gray-50 transition text-black">Cancel</button>
                    <button type="submit" class="flex-1 py-4 bg-black text-white text-xs uppercase tracking-widest font-bold hover:bg-gray-800 transition shadow-lg shadow-black/10">Save Record</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Firebase Integration -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously, onAuthStateChanged, signInWithCustomToken } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, collection, addDoc, onSnapshot, doc, updateDoc, deleteDoc, serverTimestamp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // --- 1. PORTABLE FIREBASE CONFIGURATION ---
        // Replace the values below with your actual Firebase project settings
        const firebaseConfig = {
            apiKey: "YOUR_API_KEY",
            authDomain: "YOUR_PROJECT_ID.firebaseapp.com",
            projectId: "YOUR_PROJECT_ID",
            storageBucket: "YOUR_PROJECT_ID.appspot.com",
            messagingSenderId: "YOUR_MESSAGING_ID",
            appId: "YOUR_APP_ID"
        };

        // If you are still testing within this platform, the code will try to use the environment config.
        const actualConfig = (typeof __firebase_config !== 'undefined') ? JSON.parse(__firebase_config) : firebaseConfig;
        const appId = (typeof __app_id !== 'undefined') ? __app_id : 'maniniyot-studio-v1';

        const app = initializeApp(actualConfig);
        const auth = getAuth(app);
        const db = getFirestore(app);

        // State
        let bookings = [];
        let currentCalendarDate = new Date();
        let selectedCalendarDate = null;

        // --- GLOBAL UI ACTIONS (Immediate Availability) ---
        
       window.toggleModal = (show) => {
    const modal = document.getElementById('bookingModal');
    if (!modal) return;
    
    modal.classList.toggle('hidden', !show);
    
    if (!show) {
        const form = document.getElementById('bookingForm');
        if (form) form.reset();
        // Reset the title back to default
        document.querySelector('#bookingModal h2').innerText = "New Booking Entry";
    }
    lucide.createIcons();
};

        window.switchView = (viewName) => {
            const bookingsView = document.getElementById('view-bookings');
            const scheduleView = document.getElementById('view-schedule');
            if (!bookingsView || !scheduleView) return;

            bookingsView.classList.toggle('hidden', viewName !== 'bookings');
            scheduleView.classList.toggle('hidden', viewName !== 'schedule');

            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('bg-black', 'text-white');
                btn.classList.add('text-gray-400');
            });
            const activeBtn = document.getElementById('nav-' + viewName);
            if (activeBtn) {
                activeBtn.classList.add('bg-black', 'text-white');
                activeBtn.classList.remove('text-gray-400');
            }
            
            if (viewName === 'schedule') renderCalendar();
            lucide.createIcons();
        };

const form = document.getElementById('bookingForm');

if (form) {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.innerText = "Saving Record...";

        const fd = new FormData(form);

        // 🔍 DEBUG: see what's being sent
        for (let pair of fd.entries()) {
            console.log(pair[0], pair[1]);
        }

        try {
            const res = await fetch('save_booking.php', {
                method: 'POST',
                body: fd
            });

            const text = await res.text(); // ✅ safer than res.json()
            console.log("RAW RESPONSE:", text);

            const data = JSON.parse(text); // manually parse

            if (data.success) {
                alert('Booking saved successfully!');
                form.reset();
                toggleModal(false);
                loadBookings();
            } else {
                alert('Error: ' + data.message);
            }

        } catch (err) {
            console.error(err);
            alert('Submission failed: ' + err.message);
        } finally {
            btn.disabled = false;
            btn.innerText = "Save Record";
        }
    });
}

        window.updateBookingStatus = async (id, status) => {
            try {
                // Portable Path Rule
                const ref = doc(db, 'artifacts', appId, 'public', 'data', 'bookings', id);
                await updateDoc(ref, { status });
            } catch (e) { console.error(e); }
        };

       window.deleteBooking = async (id) => {
    if (confirm('Are you sure you want to delete this booking?')) {
        try {
            const res = await fetch('delete_booking.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                // Use URLSearchParams to safely encode the ID
                body: new URLSearchParams({ 'id': id }) 
            });

            // Check if the server actually sent a 200 OK
            if (!res.ok) {
                const errorText = await res.text();
                console.error("Server Error Detail:", errorText);
                throw new Error(`Server returned status ${res.status}`);
            }

            const data = await res.json();
            if (data.success) {
                alert('Booking deleted successfully!');
                loadBookings(); // This will now also refresh your calendar colors!
            } else {
                alert('Delete failed: ' + data.message);
            }
        } catch (e) {
            console.error("Fetch Error:", e);
            alert('Delete request failed. Check the console for details.');
        }
    }
};

        window.handleLogout = () => {
            // In portable mode, we go to your main HTML file
            location.href = 'portfolio.html';
        };

        window.changeMonth = (delta) => {
            currentCalendarDate.setMonth(currentCalendarDate.getMonth() + delta);
            renderCalendar();
        };

        // --- CORE LOGIC ---

        const startDatabaseListener = async () => {
            try {
                // Try Custom Token first (Environment), fall back to Anonymous (Portable)
                if (typeof __initial_auth_token !== 'undefined' && __initial_auth_token) {
                    await signInWithCustomToken(auth, __initial_auth_token);
                } else {
                    await signInAnonymously(auth);
                }
                
                onAuthStateChanged(auth, (user) => {
                    if (user) {
                        const bookingsCol = collection(db, 'artifacts', appId, 'public', 'data', 'bookings');
                        onSnapshot(bookingsCol, (snapshot) => {
                            bookings = snapshot.docs.map(d => ({ id: d.id, ...d.data() }));
                            bookings.sort((a, b) => new Date(b.date) - new Date(a.date));
                            updateDashboard();
                        }, (err) => {
                            console.error("Firestore Error:", err);
                        });
                    }
                });
            } catch (e) {
                console.error("Auth init failed:", e);
            }
        };

       

      const updateStats = () => {
    const revEl = document.getElementById('stat-revenue');
    const totEl = document.getElementById('stat-total'); 
    const penEl = document.getElementById('stat-pending');
    const conEl = document.getElementById('stat-confirmed');

    // Get today's date in YYYY-MM-DD format (local time)
    const now = new Date();
    const todayStr = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}`;

    // 1. Total Revenue: Only sum 'completed' bookings using agreed_price
    const totalRevenue = bookings.reduce((sum, b) => {
        const price = parseFloat(b.agreed_price) || 0;
        return b.status === 'completed' ? sum + price : sum;
    }, 0);

    // 2. Today's Shoots: Count where shoot_date matches today
    const activeToday = bookings.filter(b => b.shoot_date === todayStr).length;

    // 3. Pending Count
    const pendingCount = bookings.filter(b => b.status === 'pending').length;

    // 4. Confirmed Count
    const confirmedCount = bookings.filter(b => b.status === 'confirmed').length;

    // --- Update the UI ---
    if (revEl) revEl.innerText = `₱${totalRevenue.toLocaleString('en-PH', { minimumFractionDigits: 2 })}`;
    if (totEl) totEl.innerText = activeToday;
    if (penEl) penEl.innerText = pendingCount;
    if (conEl) conEl.innerText = confirmedCount;
};

//load bookings
       async function loadBookings() {
    const tbody = document.getElementById('bookings-tbody');
    const res = await fetch('get_bookings.php');
    const data = await res.json();

    // --- THIS IS THE NEW PART ---
    bookings = data; // Put the data from PHP into our 'bookings' storage box
    updateStats();
    renderCalendar(); // Tell the calendar: "Hey, we have new data! Re-draw yourself."
    // --

    tbody.innerHTML = data.map(b => `
        <tr class="bg-gray-50/50 text-[10px] uppercase tracking-widest text-gray-500 font-bold border-b border-gray-100">
            <td class="px-6 py-4">${b.fullname}</td>
            <td class="px-6 py-4">${b.email_address}</td>
            <td class="px-6 py-4">${b.contact_number}</td>
            <td class="px-6 py-4">${b.location}</td>
            <td class="px-6 py-4">${b.service_type}</td>
            <td class="px-6 py-4">${b.shoot_date}</td>
            <td class="px-6 py-4"> ₱${Number(b.agreed_price).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
            <td class="px-6 py-4"><span class="text-gray-500 italic capitalize font-light">${b.booking_notes}</span></td>
            <td class="px-6 py-4"> <span class="${b.status === 'pending' ? 'text-orange-400' : b.status === 'confirmed' ? 'text-green-400' : 'text-black'} font-bold uppercase">${b.status}</span></td>
            <td class="px-6 py-4">
            <!-- View/Edit Button -->
  <button onclick="viewBooking(${b.id})" class="p-2 hover:bg-gray-100 rounded transition">
    <i data-lucide="eye" class="w-4 h-4 text-black"></i>
  </button>

  <!-- Delete Button -->
  <button onclick="deleteBooking(${b.id})" class="p-2 hover:bg-red-100 rounded transition">
    <i data-lucide="trash-2" class="w-4 h-4 text-red-500"></i>
  </button>
            </td>
        </tr>
    `).join('');
     // This is crucial: re-scan DOM for new Lucide icons
    lucide.createIcons();
}
loadBookings();


        const renderCalendar = () => {
            const grid = document.getElementById('calendar-grid');
            const label = document.getElementById('calendar-month-year');
            if (!grid || !label) return;
            grid.innerHTML = '';
            
            const month = currentCalendarDate.getMonth();
            const year = currentCalendarDate.getFullYear();
            label.innerText = new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' }).format(currentCalendarDate);

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

          for (let day = 1; day <= daysInMonth; day++) {
    const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    
    // Filter our PHP data for this specific date
    const dayBookings = bookings.filter(b => b.shoot_date === dateStr);
    
    const d = document.createElement('div');
    d.className = `calendar-day border-b border-r border-gray-50 text-sm text-black`;
    
    if (dayBookings.length > 0) {
        d.classList.add('has-booking');

        // Logic to decide which color to show if multiple bookings exist
        const hasCompleted = dayBookings.some(b => b.status === 'completed');
        const hasConfirmed = dayBookings.some(b => b.status === 'confirmed');
        const hasPending   = dayBookings.some(b => b.status === 'pending');

        if (hasCompleted) {
            d.classList.add('bg-status-completed'); // Green
        } else if (hasConfirmed) {
            d.classList.add('bg-status-confirmed'); // Blue
        } else if (hasPending) {
            d.classList.add('bg-status-pending');   // Orange
        }
    }
    
    // Highlight today or the selected day
    const today = new Date();
    if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) d.classList.add('today');
    if (selectedCalendarDate === dateStr) d.classList.add('selected-day');

    d.innerText = day;
    d.onclick = () => selectDate(dateStr, dayBookings);
    grid.appendChild(d);
}
            lucide.createIcons();
        };

        const selectDate = (dateStr, dayBookings) => {
    selectedCalendarDate = dateStr;
    renderCalendar();

    const title = document.getElementById('selected-date-title');
    const list = document.getElementById('day-details-list');
    if (!title || !list) return;
    
    title.innerText = new Date(dateStr).toLocaleDateString(undefined, { month: 'long', day: 'numeric', year: 'numeric' });
    
    if (dayBookings.length === 0) {
        list.innerHTML = `<div class="py-12 text-center text-gray-300"><p class="text-xs font-bold uppercase tracking-widest">No Sessions Scheduled</p></div>`;
        return;
    }

    list.innerHTML = dayBookings.map(b => `
        <div class="p-4 border border-gray-100 rounded-sm bg-gray-50/50 hover:border-gray-300 transition-colors">
            <div class="flex justify-between items-start mb-2">
                <span class="text-[9px] uppercase font-bold tracking-widest text-gray-400">${b.service_type}</span>
                <span class="text-[9px] uppercase font-bold tracking-widest ${b.status === 'confirmed' ? 'text-green-600' : 'text-orange-600'}">${b.status}</span>
            </div>
            <p class="font-bold text-sm mb-1 text-black">${b.fullname}</p>
            <p class="text-[10px] text-gray-400 mb-2">${b.contact_number}</p>
            <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                <span class="text-[10px] font-bold text-black">₱${Number(b.agreed_price).toLocaleString()}</span>
                <button onclick="switchView('bookings')" class="text-[9px] underline font-bold text-black">View Detail</button>
            </div>
        </div>
    `).join('');
    lucide.createIcons();
};
        // Initialize
        startDatabaseListener();
        lucide.createIcons();

//view booking
window.viewBooking = async (id) => {
    try {
        const res = await fetch(`get_booking_details.php?id=${id}`);
        const result = await res.json();

        if (result.success) {
            const b = result.data;
            const form = document.getElementById('bookingForm');
            if (!form) return;

            // 1. Set the hidden ID correctly
            const idField = document.getElementById('booking_id');
            if (idField) idField.value = b.id;

            // 2. Fill the form fields using a safer method
            const setVal = (name, val) => {
                const input = form.querySelector(`[name="${name}"]`);
                if (input) input.value = val || '';
            };

            setVal('fullname', b.fullname);
            setVal('contact_number', b.contact_number);
            setVal('email_address', b.email_address);
            setVal('location', b.location);
            setVal('service_type', b.service_type);
            setVal('status', b.status);
            setVal('shoot_date', b.shoot_date);
            setVal('agreed_price', b.agreed_price);
            setVal('booking_notes', b.booking_notes);

            // 3. Change UI and Show Modal
            const titleEl = document.querySelector('#bookingModal h2');
            if (titleEl) titleEl.innerText = "Edit Booking Details";
            
            toggleModal(true);
        } else {
            alert("Error: " + result.message);
        }
    } catch (e) {
        console.error("View Error:", e);
        alert("Failed to fetch booking details. Check the network tab.");
    }
    // REMOVED: document.getElementById('booking_id').value = ""; (This was causing the 'New Record' bug)
};

/* --- Add this inside your <script type="module"> --- */

window.openNewBookingModal = () => {
    // 1. Find the form and reset all text fields
    const form = document.getElementById('bookingForm');
    if (form) form.reset();

    // 2. Manually clear the hidden ID so it doesn't "Update" an old record
    const idField = document.getElementById('booking_id');
    if (idField) idField.value = "";
    
    // 3. Set the title back to "New Entry"
    const titleEl = document.querySelector('#bookingModal h2');
    if (titleEl) titleEl.innerText = "New Booking Entry";
    
    // 4. Open the modal
    toggleModal(true);
};
    </script>


    <script>
        //logout
function handleLogout() {
    fetch('logout.php')
        .then(() => {
            window.location.href = 'index.html';
        });
}
</script>
</body>
</html>