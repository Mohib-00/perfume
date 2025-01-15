<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    position: relative;
    color: #000; 
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url("{{ asset('images/' . $settings->image) }}") no-repeat center;
    background-size: cover;
    background-attachment: fixed;
    opacity: 0.7;
    z-index: -1;
}

.container {
    position: relative;
    background: rgba(0, 0, 0, 0.1);
    padding: 40px;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    z-index: 3;
    width: 400px;
    animation: fadeIn 1.5s ease-in-out;
    color: #000; 
}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(50px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

h2 {
    text-align: center;
    color: #333; 
    margin-bottom: 20px;
    font-size: 26px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.input-box {
    position: relative;
    margin-bottom: 25px;
}

.input-box input {
    width: 100%;
    padding: 14px;
    font-size: 16px;
    color: #333; 
    background: rgba(0, 0, 0, 0.05);
    border: none;
    border-radius: 25px;
    outline: none;
    transition: background 0.3s ease, box-shadow 0.3s ease;
}

.input-box input:focus {
    background: rgba(0, 0, 0, 0.1); 
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}

.input-box label {
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    color: #555; 
    font-size: 16px;
    pointer-events: none;
    transition: all 0.3s ease;
}

.input-box input:focus ~ label,
.input-box input:valid ~ label {
    top: -10px;
    left: 20px;
    font-size: 12px;
    color: #333; 
}

.btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(45deg, #61a0ff, #435bde);
    border: none;
    border-radius: 25px;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
    box-shadow: 0 10px 20px rgba(97, 160, 255, 0.3);
}

.btn:hover {
    background: linear-gradient(45deg, #435bde, #2b59c0);
    transform: translateY(-2px);
}

.already-account {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

.already-account a {
    color: #61a0ff; 
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

.already-account a:hover {
    color: #435bde;
}

svg.userpage {
    cursor: pointer;
    fill: #333; 
    transition: transform 0.3s, fill 0.3s;
}

svg.userpage:hover {
    fill: #61a0ff;
    transform: rotate(10deg);
}

  </style>
  