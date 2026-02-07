const express = require('express');
const path = require('path');
const app = express();
const PORT = 3000;

// Middleware
app.use(express.json());
app.use(express.static(path.join(__dirname, '.'))); // Serves your index.html and style.css

// 1. DATABASE (Mock)
// In a real system, this would be a MongoDB or SQL database.
let appointments = [];

// 2. LOGIC: API to handle bookings
app.post('/api/book', (req, res) => {
    const { patientName, serviceId, date, time } = req.body;

    // CONSTRAINT: Prevent Double Booking
    // We check if an appointment already exists for the same date AND time.
    const isBooked = appointments.some(app => app.date === date && app.time === time);

    if (isBooked) {
        return res.status(400).json({ 
            success: false, 
            message: "This slot is already taken. Please choose another time." 
        });
    }

    // CONSTRAINT: No Weekend Bookings (Private Clinic Policy)
    const day = new Date(date).getUTCDay();
    if (day === 0 || day === 6) { // 0 = Sunday, 6 = Saturday
        return res.status(400).json({ 
            success: false, 
            message: "The clinic is closed on weekends. Please select a weekday." 
        });
    }

    // Save to "Database"
    const newAppointment = {
        id: appointments.length + 1,
        patientName,
        serviceId,
        date,
        time,
        createdAt: new Date()
    };
    
    appointments.push(newAppointment);
    console.log("New Appointment:", newAppointment);

    res.status(201).json({ 
        success: true, 
        message: "Your appointment has been successfully scheduled!" 
    });
});

// 3. API to view all appointments (For the Admin/Dentist)
app.get('/api/admin/appointments', (req, res) => {
    res.json(appointments);
});

app.listen(PORT, () => {
    console.log(`
    🦷 SMALLBANG Dental Server is LIVE!
    -----------------------------------
    Local: http://localhost:${PORT}
    Admin View: http://localhost:${PORT}/api/admin/appointments
    `);
});