"use client";

import { useEffect, useState } from 'react';
import { useRouter , usePathname } from 'next/navigation'; // App Router 用に変更
import http from '@/lib/axios';
import { User } from '@/types/User';

const useAuth = () => {
  const [user, setUser] = useState<User | null>(null);
  const [loading, setLoading] = useState(true);
  const router = useRouter();
  const pathname = usePathname(); // 現在のパス名を取得

  useEffect(() => {
    const fetchUser = async () => {
      try {
        const response = await http.get('/api/user');
        setUser(response.data);
      } catch (error) {
        setUser(null);
        if (typeof window !== 'undefined') {
          if ( pathname === '/secret' ) router.push('/login');
          if ( pathname === '/guildSetting' ) router.push('/login');
        }
      } finally {
        setLoading(false);
      }
    };

    fetchUser();
  }, [router, pathname]);

  return { user, loading };
};

export default useAuth;
