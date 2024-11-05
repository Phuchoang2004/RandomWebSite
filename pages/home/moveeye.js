document.querySelector('body').addEventListener('mousemove', eyeball);
        function eyeball(event) {
            let eyes = document.querySelectorAll('.eye');
            eyes.forEach(eye => {
                let x = eye.getBoundingClientRect().left + eye.clientWidth / 2;
                let y = eye.getBoundingClientRect().top + eye.clientHeight / 2;
                
                // Calculate angle (in radians)
                let radian = Math.atan2(event.pageX - x, event.pageY - y);
                
                // Convert radians into degrees
                let rotate = (radian * (180 / Math.PI) * -1) + 270;
                
                // Correctly applying template literals with backticks
                eye.style.transform = `rotate(${rotate}deg)`;
            });
        }