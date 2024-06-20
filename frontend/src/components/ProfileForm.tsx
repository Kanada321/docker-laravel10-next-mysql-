"use client";

import React, { useState, useEffect } from 'react';
import http from '@/lib/axios';
import { useAuth } from '@/context/AuthContext';
import { User } from '@/types/User';

const ProfileForm = () => {
    const user = useAuth();
    const [lv, setLv] = useState<number>(1);
    const [userClass, setUserClass] = useState<string>('');

    useEffect(() => {
        if (user) {
            setLv(user.lv);
            setUserClass(user.class);
        }
    }, [user]);

    const handleUpdateProfile = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();

        try {
            await http.put('/api/user/profile', { lv, class: userClass });
            alert('Profile updated successfully');
        } catch (error) {
            console.error('Update profile error:', error);
        }
    };

    return (
        <form onSubmit={handleUpdateProfile}>
            <div>
                <label>Level</label>
                <input
                    type="number"
                    value={lv}
                    onChange={(e) => setLv(parseInt(e.target.value, 10))}
                    min="1"
                    required
                />
            </div>
            <div>
                <label>Class</label>
                <input
                    type="text"
                    value={userClass}
                    onChange={(e) => setUserClass(e.target.value)}
                    required
                />
            </div>
            <button type="submit">Update Profile</button>
        </form>
    );
};

export default ProfileForm;
