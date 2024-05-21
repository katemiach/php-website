<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Чат</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .chat-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 70px;
            height: 70px;
            background-color: #FFCC00; /* Желтый фон */
            color: #333; /* Темный цвет иконки */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            font-size: 30px;
        }
        .chat-container {
            position: fixed;
            bottom: 100px;
            right: 20px;
            width: 300px;
            max-height: 500px;
            background-color: white;
            border: 2px solid #FFCC00; /* Желтая рамка */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: none;
            flex-direction: column;
            overflow: hidden;
        }
        .chat-header {
            background-color: #FFCC00; /* Желтая шапка */
            color: #333;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        .chat-messages {
            flex-grow: 1;
            padding: 10px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }
        .chat-input {
            display: flex;
            flex-direction: column;
            border-top: 2px solid #FFCC00; /* Желтая граница сверху */
            padding: 10px;
            background-color: #fff;
        }
        .chat-input input {
            border: 2px solid #FFCC00; /* Желтая граница ввода */
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .chat-input button {
            border: none;
            background-color: #FFCC00; /* Желтая кнопка */
            color: #333;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }
        .message {
            padding: 10px;
            margin: 5px 0;
            border-radius: 10px;
            background-color: #FFFAE6; /* Светло-желтый фон сообщения */
            width: fit-content;
            max-width: 80%;
        }
        .timestamp {
            font-size: 0.8em;
            color: #888;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="chat-icon" id="chat-icon">&#x1F4AC;</div>
    <div class="chat-container" id="chat-container">
        <div class="chat-header">Чат</div>
        <div id="chat-messages" class="chat-messages"></div>
        <form id="chat-form" class="chat-input">
            <input type="text" id="user-name" placeholder="Ваше ім'я" required>
            <input type="text" id="user-input" placeholder="Напишіть повідомлення..." required>
            <button type="submit">Надіслати</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ws = new WebSocket('ws://localhost:8080');
            const chatMessages = document.getElementById('chat-messages');
            const chatIcon = document.getElementById('chat-icon');
            const chatContainer = document.getElementById('chat-container');

            const storedMessages = JSON.parse(localStorage.getItem('chatMessages')) || [];
            storedMessages.forEach(message => {
                appendMessage(message);
            });

            ws.onmessage = event => {
                console.log("Raw message received:", event.data);
                try {
                    const message = JSON.parse(event.data);
                    console.log("Parsed message received:", message);
                    appendMessage(message);
                    storeMessage(message);
                } catch (e) {
                    console.error("Error parsing message:", e);
                }
            };

            ws.onopen = () => {
                console.log("WebSocket connection established.");
            };

            ws.onerror = error => {
                console.error("WebSocket error:", error);
            };

            ws.onclose = () => {
                console.log("WebSocket connection closed.");
            };

            document.getElementById('chat-form').onsubmit = e => {
                e.preventDefault();
                const userName = document.getElementById('user-name').value;
                const userInput = document.getElementById('user-input').value;
                if (!userName || !userInput) {
                    alert('Please enter both a name and a message.');
                    return;
                }
                const message = {
                    user: userName,
                    text: userInput,
                    date: new Date().toLocaleString()
                };
                console.log("Sending message:", message);
                ws.send(JSON.stringify(message));
                document.getElementById('user-input').value = '';
                appendMessage(message);  // Отображаем сообщение немедленно
            };

            chatIcon.onclick = () => {
                chatContainer.style.display = chatContainer.style.display === 'flex' ? 'none' : 'flex';
            };

            function appendMessage(message) {
                if (!message.user || !message.text) {
                    console.error('Invalid message format:', message);
                    return;
                }
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('message');
                messageDiv.innerHTML = `<strong>${message.user}:</strong> ${message.text} <div class="timestamp">${message.date}</div>`;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function storeMessage(message) {
                const messages = JSON.parse(localStorage.getItem('chatMessages')) || [];
                messages.push(message);
                localStorage.setItem('chatMessages', JSON.stringify(messages));
            }
        });
    </script>
</body>
</html>
