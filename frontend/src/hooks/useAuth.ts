"use client"

import { useEffect, useState } from 'react'
import { useRouter, usePathname } from 'next/navigation'
import http from '@/lib/axios'
import { useAuth } from '@/context/AuthContext';

const useAuthHook = () => {
  const { setUser } = useAuth();
  const router = useRouter();
  const pathname = usePathname();

  useEffect(() => {
    const fetchUser = async () => {
      try {
        const response = await http.get('/api/user');
        setUser(response.data);
      } catch (error) {
        setUser(null);
        if (typeof window !== 'undefined') {
          if (pathname === '/secret' || pathname === '/guildSetting') {
            router.push('/login');
          }
        }
      }
    };

    fetchUser();
  }, [pathname, router, setUser]);

  return null;
};

export default useAuthHook;
