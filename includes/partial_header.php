<?php
// includes/partial_header.php
// Minimal header for chat/mobile screens
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Support | StudentsArea</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Minimal reset for chat header */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <!-- Minimal Header -->
    <header class="chat-header" style="
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: linear-gradient(135deg, var(--luxury-blue) 0%, var(--luxury-blue-light) 100%);
        color: white;
        display: flex;
        align-items: center;
        padding: 0 16px;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    ">
        <!-- Back Button -->
        <button onclick="window.history.back()" style="
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            padding: 8px;
            margin-right: 12px;
            cursor: pointer;
        ">
            <i class="fas fa-arrow-left"></i>
        </button>
        
        <!-- Logo/Title -->
        <div style="flex: 1; display: flex; align-items: center;">
            <div style="
                width: 36px;
                height: 36px;
                background: white;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 12px;
            ">
                <span style="
                    color: var(--luxury-blue);
                    font-weight: 800;
                    font-size: 18px;
                ">SA</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px;">Live Support</div>
                <div style="font-size: 12px; opacity: 0.8;">Always here to help</div>
            </div>
        </div>
        
        <!-- Action Button -->
        <button onclick="toggleMenu()" style="
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            padding: 8px;
            cursor: pointer;
        ">
            <i class="fas fa-ellipsis-v"></i>
        </button>
    </header>

    <!-- Menu Dropdown -->
    <div id="chatMenu" style="
        position: fixed;
        top: 60px;
        right: 16px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        display: none;
        z-index: 1001;
        min-width: 180px;
    ">
        <button onclick="endChat()" style="
            display: block;
            width: 100%;
            padding: 12px 16px;
            border: none;
            background: none;
            text-align: left;
            font-size: 14px;
            color: #333;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        ">
            <i class="fas fa-times-circle me-2"></i> End Chat
        </button>
        <button onclick="clearHistory()" style="
            display: block;
            width: 100%;
            padding: 12px 16px;
            border: none;
            background: none;
            text-align: left;
            font-size: 14px;
            color: #333;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        ">
            <i class="fas fa-trash me-2"></i> Clear History
        </button>
        <button onclick="downloadTranscript()" style="
            display: block;
            width: 100%;
            padding: 12px 16px;
            border: none;
            background: none;
            text-align: left;
            font-size: 14px;
            color: #333;
            cursor: pointer;
        ">
            <i class="fas fa-download me-2"></i> Save Chat
        </button>
    </div>

    <script>
    function toggleMenu() {
        const menu = document.getElementById('chatMenu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }
    
    function endChat() {
        if (confirm('Are you sure you want to end this chat?')) {
            window.location.href = 'index.php';
        }
    }
    
    function clearHistory() {
        if (confirm('Clear all chat history?')) {
            localStorage.removeItem('chatHistory');
            alert('History cleared!');
            toggleMenu();
        }
    }
    
    function downloadTranscript() {
        alert('Chat transcript would be downloaded');
        toggleMenu();
    }
    
    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('chatMenu');
        const menuButton = event.target.closest('button[onclick="toggleMenu()"]');
        
        if (!menu.contains(event.target) && !menuButton) {
            menu.style.display = 'none';
        }
    });
    </script>