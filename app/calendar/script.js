// Create stars in the background
function createStars() {
    const starsContainer = document.getElementById('stars');
    const starCount = 100;
    
    for (let i = 0; i < starCount; i++) {
        const star = document.createElement('div');
        star.classList.add('star');
        
        const x = Math.random() * 100;
        const y = Math.random() * 100;
        
        const size = Math.random() * 2 + 1;
        const opacity = Math.random() * 0.5 + 0.3;
        const duration = Math.random() * 3 + 2;
        
        star.style.left = `${x}%`;
        star.style.top = `${y}%`;
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;
        star.style.opacity = opacity;
        star.style.setProperty('--duration', `${duration}s`);
        star.style.setProperty('--opacity', opacity);
        
        starsContainer.appendChild(star);
    }
}

function updateClock() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            document.getElementById("clock").innerText = xhr.responseText;
        }
    };
    xhr.open('GET', 'clock.php', true);
    xhr.send();
}

function simulateInitialLoading() {
    if (sessionStorage.getItem('hasVisited')) {
        const loadingScreen = document.getElementById('loading-screen');
        loadingScreen.style.display = 'none';
        return;
    }
    
    sessionStorage.setItem('hasVisited', 'true');
    
    const progressBar = document.getElementById('loading-progress');
    const loadingScreen = document.getElementById('loading-screen');
    let progress = 0;
    
    const interval = setInterval(() => {
        progress += Math.random() * 10;
        if (progress >= 100) {
            progress = 100;
            clearInterval(interval);
            
            setTimeout(() => {
                loadingScreen.style.opacity = '0';
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                }, 500);
            }, 500);
        }
        
        progressBar.style.width = `${progress}%`;
    }, 200);
}

function setupFormLoading() {
    const calendarForm = document.querySelector('form');
    const dateInput = document.getElementById('date');
    
    dateInput.addEventListener('click', function(e) {
        this.showPicker();
    });
    
    calendarForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const calendarLoading = document.getElementById('calendar-loading');
        calendarLoading.style.display = 'flex';

        document.body.classList.add('blur-background');

        setTimeout(() => {
            calendarLoading.style.opacity = '1';
        }, 10);

        setTimeout(() => {
            calendarLoading.style.opacity = '0';
            document.body.classList.remove('blur-background');
            
            setTimeout(() => {
                calendarLoading.style.display = 'none';
                this.submit();
            }, 300);
        }, Math.random() * 500 + 250);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    createStars();
    simulateInitialLoading();
    setupFormLoading();
    setInterval(updateClock, 1000);
    updateClock();
});
