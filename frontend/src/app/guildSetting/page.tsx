"use client"

import React, { useEffect, useState } from 'react';
import { useRouter, useSearchParams } from 'next/navigation';
import useAuth from '@/hooks/useAuth';
import http from '@/lib/axios';

const GuildSetting = () => {
  const [guildName, setGuildName] = useState<string | null>(null);
  const [parameter, setParameter] = useState<string | null>(null);
  const { user, loading } = useAuth();
  const router = useRouter();
  const searchParams = useSearchParams();
  const guildId = searchParams.get('guildId');

  useEffect(() => {
    if (!loading && user && guildId) {
      fetchParameter(guildId);
    }
  }, [loading, user, guildId]);

  const fetchParameter = async (guildId: string) => {
    try {
      const response = await fetch(`/api/guild/parameters/${guildId}`, {
        method: 'GET',
        credentials: 'include',  // クッキーを含めるため
      });
      if (response.ok) {
        const data = await response.json();
        setParameter(data.parameter);
      } else {
        console.error('Error fetching parameter:', response.statusText);
      }
    } catch (error) {
      console.error('Error fetching parameter:', error);
    }
  };

  if (loading) {
    return <div>Loading...</div>;
  }

  if (!user) {
    router.push('/login');
    return null;
  }

  return (
    <div>
      <h1>Guild settings</h1>
      {parameter ? (
        <div>
          <p>Guild Parameter: { parameter }</p>
        </div>
      ) : (
        <p>Loading guild information...</p>
      )}
    </div>
  );
};

export default GuildSetting;
