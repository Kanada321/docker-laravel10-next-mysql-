"use client";

import React, { useEffect, useState } from 'react';
import { useRouter, useSearchParams } from 'next/navigation';
import { useAuth } from '@/context/AuthContext';
import GuildSetForm from '@/components/guildSetting/guildSetForm';

interface GuildData {
  name: string | null;
  parameter: string | null;
  description: string | null;
  old_password: boolean;
  use_pass: boolean;
  // さらに項目が増える場合はここに追加
}

const GuildSetting = () => {
  const [guildData, setGuildData] = useState<GuildData>({
    name: null,
    parameter: null,
    description: null,
    old_password: false,
    use_pass: false,
  });

  const { user, loading } = useAuth();
  const router = useRouter();
  const searchParams = useSearchParams();
  const guildId = searchParams.get('guildId');
  const [loadingGuildData, setLoadingGuildData] = useState(true);

  // useEffect(() => {
  //   if (!loading) {
  //     // router.push('/login');
  //     console.log("Loading guild...");
  //   }
  //   if ( !user) {
  //     // router.push('/login');
  //     console.log("user guild...");
  //   }
  //   if (!loading && !user) {
  //     // router.push('/login');
  //     console.log("Loading guild2...");
  //   }
  // }, [loading, user, router]);

  useEffect(() => {
    if (!loading && user && guildId) {
      fetchGuildData(guildId);
    }
  }, [loading, user, guildId]);

  const fetchGuildData = async (guildId: string) => {
    try {
      const response = await fetch(`/api/guild/fetch-guild/${guildId}`, {
        method: 'GET',
        credentials: 'include', // クッキーを含めるため
      });
      if (response.ok) {
        const data = await response.json();
        setGuildData(data);
      } else {
        console.error('Error fetching parameter:', response.statusText);
      }
    } catch (error) {
      console.error('Error fetching parameter:', error);
    } finally {
      setLoadingGuildData(false);
    }
  };

  if (loading || loadingGuildData) {
    return <div>Loading...</div>;
  }

  return (
    <div className="p-8 rounded border border-gray-200">
      <h1 className="font-medium text-3xl">Guild settings</h1>
      {guildData.parameter && guildId ? (
        <div>
          <p className="text-gray-600 mt-6">Guild Parameter: {guildData.parameter}</p>
          <GuildSetForm
            guildId={guildId}
            initialData={{
              name: guildData.name ?? '',
              description: guildData.description ?? '',
              old_password: guildData.old_password,
              use_pass: guildData.use_pass,
            }}
          />
        </div>
      ) : (
        <p>Loading guild information...</p>
      )}
    </div>
  );
};

export default GuildSetting;
