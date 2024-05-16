'use client';

import React, { useState } from 'react';
import axios from 'axios';

const http = axios.create({
    baseURL: 'http://localhost:802/',
    withCredentials: true,
});

const LoginForm = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const handleLogin = async (event: React.FormEvent) => {
        event.preventDefault();
        try {
            await http.get('/sanctum/csrf-cookie');
            const response = await http.post('/api/login', { email, password });
            console.log(response.data);
            // ログイン成功後の処理をここに追加
        } catch (error) {
            console.error('Login failed:', error);
        }
    };

    return (
        <form onSubmit={handleLogin}>
            <div>
                <label>Email</label>
                <input
                    type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                />
            </div>
            <div>
                <label>Password</label>
                <input
                    type="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                />
            </div>
            <button type="submit">Login</button>
        </form>
    );
};

export default LoginForm;
