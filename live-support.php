<?php
// live-support.php
$pageTitle = "Live Support - Get Instant Help";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $pageTitle; ?> | StudentsArea</title>
    
    <!-- Emoji Picker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/emoji-picker-element@1.14.0/dist/index.css">
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="assets/css/extra.min.css">
    <link rel="stylesheet" href="assets/css/main.min.css">

    <style>
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: #f0f2f5;
            height: 100vh;
            padding: 0;
            overflow: hidden;
            -webkit-tap-highlight-color: transparent;
        }
        
        /* Main Chat Container */
        .chat-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            background: #f0f2f5;
        }
        
        /* Chat Header */
        .chat-header {
            background: linear-gradient(135deg, var(--luxury-blue) 0%, var(--luxury-blue-light) 100%);
            color: white;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .agent-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gold-accent);
        }
        
        .agent-info {
            flex: 1;
        }
        
        .agent-name {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 2px;
        }
        
        .agent-status {
            font-size: 13px;
            opacity: 0.9;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .status-dot {
            width: 6px;
            height: 6px;
            background: #4CAF50;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        
        .header-actions {
            display: flex;
            gap: 8px;
        }
        
        .header-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .header-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        /* Chat Body */
        .chat-body {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Messages */
        .message {
            display: flex;
            max-width: 85%;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .message.incoming {
            align-self: flex-start;
        }
        
        .message.outgoing {
            align-self: flex-end;
        }
        
        .message-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            align-self: flex-end;
            margin-bottom: 4px;
        }
        
        .message.incoming .message-avatar {
            margin-right: 8px;
        }
        
        .message.outgoing .message-avatar {
            margin-left: 8px;
        }
        
        .message-content {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }
        
        .message-bubble {
            padding: 12px 16px;
            border-radius: 18px;
            position: relative;
            word-wrap: break-word;
            line-height: 1.4;
            font-size: 15px;
        }
        
        .message.incoming .message-bubble {
            background: white;
            color: #111;
            border-top-left-radius: 4px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        .message.outgoing .message-bubble {
            background: linear-gradient(135deg, #00a884, #00bfa5);
            color: white;
            border-top-right-radius: 4px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        .message-time {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 4px;
            text-align: right;
        }
        
        .message.outgoing .message-time {
            color: rgba(255, 255, 255, 0.8);
        }
        
        /* System Messages */
        .system-message {
            text-align: center;
            margin: 8px 0;
        }
        
        .system-text {
            background: rgba(0, 0, 0, 0.05);
            color: #666;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            display: inline-block;
        }
        
        /* Typing Indicator */
        .typing-indicator {
            background: white;
            padding: 12px 16px;
            border-radius: 18px;
            border-top-left-radius: 4px;
            max-width: 70px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        .typing-dots {
            display: flex;
            gap: 4px;
        }
        
        .typing-dot {
            width: 8px;
            height: 8px;
            background: #999;
            border-radius: 50%;
            animation: typing 1.4s infinite ease-in-out;
        }
        
        .typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .typing-dot:nth-child(2) { animation-delay: -0.16s; }
        
        @keyframes typing {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }
        
        /* Quick Replies */
        .quick-replies {
            padding: 12px 16px;
            background: white;
            border-top: 1px solid #e0e0e0;
            display: flex;
            gap: 8px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            flex-shrink: 0;
        }
        
        .quick-reply-btn {
            background: #f0f2f5;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 14px;
            color: #111;
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        
        .quick-reply-btn:hover {
            background: var(--luxury-blue);
            color: white;
            border-color: var(--luxury-blue);
        }
        
        /* Chat Footer */
        .chat-footer {
            background: white;
            padding: 12px 16px;
            border-top: 1px solid #e0e0e0;
            display: flex;
            align-items: flex-end;
            gap: 12px;
            flex-shrink: 0;
        }
        
        .message-input-container {
            flex: 1;
            display: flex;
            align-items: center;
            background: #f0f2f5;
            border-radius: 24px;
            padding: 8px 16px;
            gap: 8px;
            min-height: 48px;
        }
        
        .message-input {
            flex: 1;
            border: none;
            background: transparent;
            padding: 4px 0;
            font-size: 15px;
            outline: none;
            resize: none;
            max-height: 120px;
            min-height: 24px;
            font-family: inherit;
            line-height: 1.4;
        }
        
        .input-action-btn {
            background: transparent;
            border: none;
            color: #666;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
            transition: background 0.2s;
        }
        
        .input-action-btn:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        
        .send-btn {
            background: linear-gradient(135deg, #00a884, #00bfa5);
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
            transition: all 0.2s;
        }
        
        .send-btn:hover {
            background: linear-gradient(135deg, #008f74, #00a58c);
            transform: scale(1.05);
        }
        
        .send-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }
        
        /* Emoji Picker */
        .emoji-picker-container {
            position: absolute;
            bottom: 70px;
            right: 16px;
            z-index: 1000;
            display: none;
        }
        
        /* File Preview */
        .file-preview {
            max-width: 200px;
            padding: 8px;
            background: white;
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            margin-top: 8px;
        }
        
        .file-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .file-icon {
            font-size: 20px;
            color: var(--luxury-blue);
        }
        
        .file-name {
            font-size: 13px;
            color: #333;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        /* Connection Status */
        .connection-status {
            position: fixed;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            z-index: 1000;
            animation: slideInRight 0.3s ease;
        }
        
        @keyframes slideInRight {
            from { transform: translateX(100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        /* Scrollbar Styling */
        .chat-body::-webkit-scrollbar {
            width: 4px;
        }
        
        .chat-body::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .chat-body::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }
        
        /* Mobile Optimizations */
        @media (max-width: 768px) {
            .message {
                max-width: 90%;
            }
            
            .message-bubble {
                padding: 10px 14px;
                font-size: 14px;
            }
            
            .quick-replies {
                padding: 10px 12px;
            }
            
            .quick-reply-btn {
                padding: 6px 12px;
                font-size: 13px;
            }
            
            .chat-footer {
                padding: 10px 12px;
                gap: 2px;
            }
            
            .connection-status {
                font-size: 12px;
                padding: 6px 12px;
            }
            .message-input-container{
                flex: 1;
                display: flex;
                align-items: center;
                background: #f0f2f5;
                border-radius: 20px;
                padding: 0px 12px;
                gap: 8px;
                min-height: 40px;                
            }
            .chat-header {
                padding: 0;
            }
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            body {
                background: #0a0a0a;
            }
            
            .chat-body {
                background: #0a0a0a;
            }
            
            .message.incoming .message-bubble {
                background: #1e1e1e;
                color: #f0f0f0;
            }
            
            .quick-replies {
                background: #1e1e1e;
                border-color: #2e2e2e;
            }
            
            .quick-reply-btn {
                background: #2e2e2e;
                border-color: #3e3e3e;
                color: #f0f0f0;
            }
            
            .chat-footer {
                background: #1e1e1e;
                border-color: #2e2e2e;
            }
            
            .message-input-container {
                background: #2e2e2e;
            }
            
            .message-input {
                color: #f0f0f0;
            }
            
            .input-action-btn {
                color: #888;
            }
        }
        
        /* Prevent text selection on buttons */
        button {
            user-select: none;
            -webkit-user-select: none;
        }
    </style>
</head>
<body>
    <!-- Connection Status -->
    <div class="connection-status">
        <i class="fas fa-wifi"></i>
        <span>Connected</span>
    </div>
    
    <!-- Main Chat Container -->
    <div class="chat-container">
        <!-- Chat Header -->
        <div class="chat-header">
            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Support Agent" class="agent-avatar">
            <div class="agent-info">
                <div class="agent-name">Sarah Johnson</div>
                <div class="agent-status">
                    <div class="status-dot"></div>
                    <span>Online • Responds quickly</span>
                </div>
            </div>
            <div class="header-actions">
                <button class="header-btn" title="More Options" onclick="window.location.href='index.php'">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <button class="header-btn" title="Voice Call" onclick="startVoiceCall()">
                    <i class="fas fa-phone"></i>
                </button>
                <button class="header-btn" title="More Options" onclick="toggleOptions()">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>
        </div>
        
        <!-- Chat Body -->
        <div class="chat-body" id="chatBody">
            <!-- Welcome Message -->
            <div class="message incoming">
                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Support Agent" class="message-avatar">
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="message-text">
                            👋 Hello! I'm Sarah from StudentsArea Support. How can I help you today? 
                            You can ask me about jobs, projects, business ideas, or any platform issues.
                        </div>
                        <div class="message-time">10:00 AM</div>
                    </div>
                </div>
            </div>
            
            <!-- System Message -->
            <div class="system-message">
                <div class="system-text">Today • 10:01 AM</div>
            </div>
            
            <!-- User Message -->
            <div class="message outgoing">
                <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="You" class="message-avatar">
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="message-text">
                            Hi Sarah! I need help finding remote jobs for web development.
                        </div>
                        <div class="message-time">10:01 AM</div>
                    </div>
                </div>
            </div>
            
            <!-- Support Agent Reply -->
            <div class="message incoming">
                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Support Agent" class="message-avatar">
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="message-text">
                            Great! I can help with that. What specific web development skills do you have? 
                            (e.g., React, Node.js, Python, etc.)
                        </div>
                        <div class="message-time">10:02 AM</div>
                    </div>
                </div>
            </div>
            
            <!-- User Message -->
            <div class="message outgoing">
                <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="You" class="message-avatar">
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="message-text">
                            I know React, JavaScript, HTML/CSS, and some Node.js.
                        </div>
                        <div class="message-time">10:02 AM</div>
                    </div>
                </div>
            </div>
            
            <!-- Support Agent Reply -->
            <div class="message incoming">
                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Support Agent" class="message-avatar">
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="message-text">
                            Perfect! I'm sending you some job opportunities now. Check your email for:
                            <br><br>
                            1. Frontend Developer Intern - $15-20/hr
                            <br>
                            2. MERN Stack Developer - $25-35/hr
                            <br><br>
                            Would you like help with your application?
                        </div>
                        <div class="message-time">10:03 AM</div>
                    </div>
                </div>
            </div>
            
            <!-- Typing Indicator -->
            <div class="message incoming" id="typingIndicator" style="display: none;">
                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Support Agent" class="message-avatar">
                <div class="typing-indicator">
                    <div class="typing-dots">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            </div>
            
            <!-- Dynamic Messages Container -->
            <div id="chatMessages"></div>
        </div>
        
        <!-- Quick Replies -->
        <div class="quick-replies">
            <button class="quick-reply-btn" onclick="sendQuickReply('Need help with job applications')">
                Job applications
            </button>
            <button class="quick-reply-btn" onclick="sendQuickReply('Project suggestions for portfolio')">
                Project ideas
            </button>
            <button class="quick-reply-btn" onclick="sendQuickReply('Technical issue with platform')">
                Technical help
            </button>
            <button class="quick-reply-btn" onclick="sendQuickReply('Business ideas for students')">
                Business ideas
            </button>
        </div>
        
        <!-- Chat Footer -->
        <div class="chat-footer">
            <button class="input-action-btn" title="Attach File" onclick="attachFile()">
                <i class="fas fa-paperclip"></i>
            </button>
            
            <button class="input-action-btn" title="Add Emoji" onclick="toggleEmojiPicker()">
                <i class="far fa-smile"></i>
            </button>
            
            <div class="message-input-container">
                <textarea 
                    class="message-input" 
                    id="messageInput" 
                    placeholder="Type a message..." 
                    rows="1"
                    oninput="autoResize(this)"
                    onkeydown="handleKeyPress(event)"
                ></textarea>
                
                <!-- Emoji Picker -->
                <div class="emoji-picker-container" id="emojiPickerContainer">
                    <emoji-picker></emoji-picker>
                </div>
            </div>
            
            <button class="send-btn" id="sendButton" onclick="sendMessage()" disabled>
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
    
    <!-- Hidden File Input -->
    <input type="file" id="fileInput" style="display: none;" onchange="handleFileSelect(event)">
    
    <!-- Emoji Picker Script -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@1.14.0/dist/index.js"></script>
    
    <script>
    // DOM Elements
    const chatBody = document.getElementById('chatBody');
    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const emojiPickerContainer = document.getElementById('emojiPickerContainer');
    const typingIndicator = document.getElementById('typingIndicator');
    const fileInput = document.getElementById('fileInput');
    
    // State
    let isTyping = false;
    let chatHistory = JSON.parse(localStorage.getItem('chatHistory')) || [];
    
    // Initialize chat
    document.addEventListener('DOMContentLoaded', function() {
        // Scroll to bottom
        scrollToBottom();
        
        // Load previous messages from history
        loadChatHistory();
        
        // Setup emoji picker
        setupEmojiPicker();
        
        // Show welcome message
        setTimeout(showTyping, 1000);
    });
    
    // Auto-resize textarea
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
        
        // Enable/disable send button
        sendButton.disabled = textarea.value.trim() === '';
    }
    
    // Handle Enter key press
    function handleKeyPress(event) {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            sendMessage();
        }
    }
    
    // Send message
    function sendMessage() {
        const message = messageInput.value.trim();
        if (!message) return;
        
        // Add user message
        addMessage('user', message);
        
        // Clear input
        messageInput.value = '';
        messageInput.style.height = 'auto';
        sendButton.disabled = true;
        
        // Scroll to bottom
        scrollToBottom();
        
        // Show typing indicator after 1 second
        setTimeout(showTyping, 1000);
        
        // Save to history
        saveToHistory('user', message);
    }
    
    // Send quick reply
    function sendQuickReply(reply) {
        messageInput.value = reply;
        sendMessage();
    }
    
    // Add message to chat
    function addMessage(type, text) {
        const timestamp = getCurrentTime();
        const messageId = Date.now();
        
        const messageElement = document.createElement('div');
        messageElement.className = `message ${type === 'user' ? 'outgoing' : 'incoming'}`;
        messageElement.id = `msg-${messageId}`;
        messageElement.innerHTML = `
            <img src="${type === 'user' ? 'https://randomuser.me/api/portraits/men/22.jpg' : 'https://randomuser.me/api/portraits/women/32.jpg'}" 
                 alt="${type === 'user' ? 'You' : 'Support Agent'}" 
                 class="message-avatar">
            <div class="message-content">
                <div class="message-bubble">
                    <div class="message-text">${escapeHtml(text)}</div>
                    <div class="message-time">${timestamp}</div>
                </div>
            </div>
        `;
        
        chatMessages.appendChild(messageElement);
        scrollToBottom();
        
        return messageId;
    }
    
    // Show typing indicator
    function showTyping() {
        if (isTyping) return;
        
        isTyping = true;
        typingIndicator.style.display = 'flex';
        scrollToBottom();
        
        // Simulate response after 2-3 seconds
        setTimeout(() => {
            hideTyping();
            generateResponse();
        }, 2000 + Math.random() * 1000);
    }
    
    // Hide typing indicator
    function hideTyping() {
        isTyping = false;
        typingIndicator.style.display = 'none';
    }
    
    // Generate response
    function generateResponse() {
        const responses = [
            "I understand. Let me help you with that. What specific area are you most interested in?",
            "Great question! I have several resources that can help you with that.",
            "Perfect timing! We just added new opportunities in that category.",
            "I can definitely assist with that. Let me gather the best information for you.",
            "That's a common question! Here's what I recommend based on your profile."
        ];
        
        const response = responses[Math.floor(Math.random() * responses.length)];
        const messageId = addMessage('support', response);
        
        // Save to history
        saveToHistory('support', response);
    }
    
    // Setup emoji picker
    function setupEmojiPicker() {
        const picker = document.querySelector('emoji-picker');
        if (picker) {
            picker.addEventListener('emoji-click', event => {
                const emoji = event.detail.unicode;
                messageInput.value += emoji;
                autoResize(messageInput);
                
                // Hide picker after selection
                emojiPickerContainer.style.display = 'none';
            });
        }
    }
    
    // Toggle emoji picker
    function toggleEmojiPicker() {
        if (emojiPickerContainer.style.display === 'block') {
            emojiPickerContainer.style.display = 'none';
        } else {
            emojiPickerContainer.style.display = 'block';
            emojiPickerContainer.style.position = 'absolute';
            emojiPickerContainer.style.bottom = '70px';
            emojiPickerContainer.style.right = '16px';
        }
    }
    
    // Close emoji picker when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.emoji-picker-container') && 
            !event.target.closest('.input-action-btn .fa-smile')) {
            emojiPickerContainer.style.display = 'none';
        }
    });
    
    // Attach file
    function attachFile() {
        fileInput.click();
    }
    
    // Handle file selection
    function handleFileSelect(event) {
        const file = event.target.files[0];
        if (!file) return;
        
        // Show file in message
        const messageId = addMessage('user', `📎 ${file.name} (${formatFileSize(file.size)})`);
        
        // Clear file input
        fileInput.value = '';
        
        // Save to history
        saveToHistory('user', `📎 ${file.name}`);
        
        // Show typing indicator
        setTimeout(showTyping, 1000);
    }
    
    // Toggle options menu
    function toggleOptions() {
        const actions = [
            { text: 'End Chat', icon: 'times-circle', action: endChat },
            { text: 'Clear History', icon: 'trash', action: clearHistory },
            { text: 'Rate Support', icon: 'star', action: rateSupport },
            { text: 'Email Transcript', icon: 'envelope', action: emailTranscript }
        ];
        
        // Create menu
        const menu = document.createElement('div');
        menu.style.cssText = `
            position: absolute;
            top: 60px;
            right: 16px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            z-index: 1000;
            min-width: 180px;
            overflow: hidden;
        `;
        
        actions.forEach(item => {
            const button = document.createElement('button');
            button.style.cssText = `
                display: flex;
                align-items: center;
                gap: 12px;
                width: 100%;
                padding: 12px 16px;
                border: none;
                background: none;
                text-align: left;
                font-size: 14px;
                color: #333;
                cursor: pointer;
                border-bottom: 1px solid #eee;
            `;
            button.onmouseover = () => button.style.background = '#f5f5f5';
            button.onmouseout = () => button.style.background = 'none';
            button.onclick = () => {
                document.body.removeChild(menu);
                item.action();
            };
            
            button.innerHTML = `
                <i class="fas fa-${item.icon}"></i>
                <span>${item.text}</span>
            `;
            
            menu.appendChild(button);
        });
        
        document.body.appendChild(menu);
        
        // Remove menu when clicking outside
        setTimeout(() => {
            const removeMenu = (e) => {
                if (!menu.contains(e.target) && !e.target.closest('.header-btn')) {
                    document.body.removeChild(menu);
                    document.removeEventListener('click', removeMenu);
                }
            };
            document.addEventListener('click', removeMenu);
        }, 0);
    }
    
    // End chat
    function endChat() {
        if (confirm('Are you sure you want to end this chat?')) {
            window.location.href = 'index.php';
        }
    }
    
    // Clear history
    function clearHistory() {
        if (confirm('Clear all chat history?')) {
            localStorage.removeItem('chatHistory');
            chatHistory = [];
            chatMessages.innerHTML = '';
            alert('History cleared!');
        }
    }
    
    // Rate support
    function rateSupport() {
        alert('Rating feature would open a rating modal');
    }
    
    // Email transcript
    function emailTranscript() {
        alert('Transcript would be emailed to you');
    }
    
    // Start voice call (simulated)
    function startVoiceCall() {
        alert('Voice call would be initiated');
    }
    
    // Scroll to bottom
    function scrollToBottom() {
        setTimeout(() => {
            chatBody.scrollTop = chatBody.scrollHeight;
        }, 100);
    }
    
    // Get current time
    function getCurrentTime() {
        const now = new Date();
        return now.getHours().toString().padStart(2, '0') + ':' + 
               now.getMinutes().toString().padStart(2, '0');
    }
    
    // Format file size
    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(1) + ' MB';
    }
    
    // Escape HTML
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Save to history
    function saveToHistory(type, message) {
        chatHistory.push({
            type,
            message,
            timestamp: new Date().toISOString()
        });
        
        // Keep only last 100 messages
        if (chatHistory.length > 100) {
            chatHistory = chatHistory.slice(-100);
        }
        
        localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
    }
    
    // Load chat history
    function loadChatHistory() {
        chatHistory.forEach(item => {
            if (item.type === 'user' || item.type === 'support') {
                addMessage(item.type, item.message);
            }
        });
    }
    
    // Auto-scroll when new messages are added
    const observer = new MutationObserver(scrollToBottom);
    observer.observe(chatMessages, { childList: true });
    </script>
</body>
</html>