"use client";

import { useEffect, useState } from 'react';
import { useRouter } from 'next/navigation';
import http from '@/lib/axios';
import { User } from '@/types/User';

const useAuth = () => {
    const [user, setUser] = useState<User | null>(null);
    const router = useRouter();

    useEffect(() => {
        const fetchUser = async () => {
            try {
                const response = await http.get('/api/user');
                setUser(response.data);
            } catch (error) {
                router.push('/login');
            }
        };

        fetchUser();
    }, [router]);

    return user;
};

export default useAuth;
