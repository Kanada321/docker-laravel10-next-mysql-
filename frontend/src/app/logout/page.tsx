"use client";

import { useEffect } from 'react';
import axios from '@/lib/axios';
import { useRouter } from 'next/navigation';

const LogoutPage = () => {
    const router = useRouter();

    useEffect(() => {
        const logout = async () => {
            try {
                await axios.post('/logout');
                router.push('/login');
            } catch (error) {
                console.error('Logout error:', error);
            }
        };

        logout();
    }, [router]);

    return <div>Logging out...</div>;
};

export default LogoutPage;