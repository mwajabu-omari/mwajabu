// Functions for Mark All buttons
function markAll(status) {
    document.querySelectorAll(".status").forEach(select => select.value = status);
}

function resetAll() {
    document.querySelectorAll(".status").forEach(select => select.value = "");
    document.querySelectorAll(".student-row").forEach(row => row.classList.remove("missing-row"));
}

document.getElementById("attendanceForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const rows = document.querySelectorAll(".student-row");
    const ids = document.querySelectorAll(".student_id");
    const statuses = document.querySelectorAll(".status");

    const msgBox = document.getElementById("msg");
    const scrollTarget = document.getElementById("scrollTarget");

    let data = [];
    let valid = true;
    let firstError = null;

    // Clear previous highlights
    rows.forEach(row => row.classList.remove("missing-row"));

    // Validate + build data
    for (let i = 0; i < statuses.length; i++) {
        const status = statuses[i].value;

        if (status === "") {
            rows[i].classList.add("missing-row");

            if (!firstError) {
                firstError = rows[i];
            }
            valid = false;
        }

        data.push({
            student_id: ids[i].value,
            status: status
        });
    }

    // ❌ TYPE 1: SCROLL TO FIRST ERROR (Instant Snap + Focus)
    if (!valid) {
        msgBox.innerHTML = "<p style='color:red; font-weight:bold;'>Please mark all students before saving.</p>";

        if (firstError) {
            // Instant behavior so it feels different from the success scroll
            firstError.scrollIntoView({
                behavior: "auto", 
                block: "center"
            });
            
            // Highlight the select input to draw the user's eye
            const targetSelect = firstError.querySelector(".status");
            if (targetSelect) targetSelect.focus();
        }
        return;
    }

    // ✅ TYPE 2: SCROLL TO SUCCESS MESSAGE (Smooth Gliding)
    fetch("save_attendance.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(res => res.text())
    .then(res => {
        msgBox.innerHTML = "<p style='color:green; font-weight:bold;'>" + res + "</p>";

        // Smooth behavior so it feels like a successful transition
        scrollTarget.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
    })
    .catch(err => {
        msgBox.innerHTML = "<p style='color:red; font-weight:bold;'>Connection error. Try again.</p>";
        scrollTarget.scrollIntoView({ behavior: "smooth", block: "start" });
    });
});
