// 1. UPDATE SUMMARY LOGIC
function updateServiceDetails() {
    const select = document.getElementById('serviceSelect');
    const summary = document.getElementById('serviceSummary');
    const displayPrice = document.getElementById('displayPrice');
    const displayTime = document.getElementById('displayTime');
    
    const selectedOption = select.options[select.selectedIndex];
    const price = selectedOption.getAttribute('data-price');
    const time = selectedOption.getAttribute('data-time');

    if (price && time) {
        summary.classList.remove('hidden');
        displayPrice.innerText = price;
        displayTime.innerText = time;
        
        // Visual feedback: brief pulse animation
        summary.style.transform = "scale(1.02)";
        setTimeout(() => summary.style.transform = "scale(1)", 200);
    }
}

// 2. FORM SUBMISSION LOGIC
document.getElementById('bookingForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const service = document.getElementById('serviceSelect').value;
    const name = document.getElementById('pName').value;
    const date = document.getElementById('appDate').value;
    const time = document.getElementById('appTime').value;
    const msgDiv = document.getElementById('msg');

    // Constraint Check: Must select a service
    if (!service) {
        msgDiv.innerHTML = "⚠️ Please select a treatment from the left panel first.";
        msgDiv.className = "error";
        return;
    }

    // Connect to your server.js
    try {
        const response = await fetch('/api/book', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                patientName: name,
                serviceId: service,
                date: date,
                time: time
            })
        });

        const result = await response.json();
        
        msgDiv.innerHTML = result.success ? `✅ ${result.message}` : `❌ ${result.message}`;
        msgDiv.className = result.success ? "success" : "error";

        if (result.success) {
            this.reset();
            document.getElementById('serviceSummary').classList.add('hidden');
        }
    } catch (error) {
        msgDiv.innerHTML = "❌ Server error. Please try again later.";
        msgDiv.className = "error";
    }
});

// 3. PAGE INITIALIZATION
document.addEventListener('DOMContentLoaded', () => {
    // Set minimum date to today so patients can't book the past
    const today = new Date().toISOString().split('T')[0];
    const dateInput = document.getElementById('appDate');
    if (dateInput) {
        dateInput.setAttribute('min', today);
    }
});