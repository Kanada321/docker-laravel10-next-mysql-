"use client";

import React, { useState } from 'react';
import http from '@/lib/axios';

interface GuildSetFormProps {
  guildId: string;
  initialData: {
    name: string;
    description: string;
    old_password: boolean;
    use_pass: boolean;
  };
}

const GuildSetForm: React.FC<GuildSetFormProps> = ({ guildId, initialData }) => {
  const [guildName, setGuildName] = useState(initialData.name);
  const [description, setDescription] = useState(initialData.description);
  const [usePass, setUsePass] = useState<boolean>(initialData.use_pass);
  const [oldPassword, setOldPassword] = useState<boolean>(initialData.old_password);
  const [password, setPassword] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsSubmitting(true);

    try {
      const response = await http.post(`/api/guild/update/${guildId}`, {
        name: guildName,
        description,
        use_pass: usePass,
        password: usePass ? password : undefined,
      });
      if (response.status === 200) {
        alert('ギルド情報が正常に更新されました！');
      } else {
        alert('ギルド情報の更新に失敗しました');
      }
    } catch (error) {
      console.error('ギルド情報の更新中にエラーが発生しました:', error);
      alert('ギルド情報の更新中にエラーが発生しました。');
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <div className="mt-8 grid lg:grid-cols-2 gap-4">
        <div className="sm:col-span-2">
          <label htmlFor="guildName" className="mb-2 inline-block text-sm text-gray-800 sm:text-base">
            ギルド名:
          </label>
          <input
            type="text"
            id="guildName"
            value={guildName}
            onChange={(e) => setGuildName(e.target.value)}
            required
            className="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring"
            placeholder="ギルド名を入力してください。"
          />
        </div>

        <div className="sm:col-span-2">
          <label htmlFor="description" className="mb-2 inline-block text-sm text-gray-800 sm:text-base">
            説明:
          </label>
          <textarea
            className="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring"
            id="description"
            value={description}
            onChange={(e) => setDescription(e.target.value)}
          ></textarea>
        </div>

        <div className="flex items-center mb-4">
          <label htmlFor="usePass" className="mb-2 inline-block text-sm text-gray-800 sm:text-base">
            パスワードを使用:
          </label>
          <input
            type="checkbox"
            id="usePass"
            checked={usePass}
            onChange={(e) => setUsePass(e.target.checked)}
            className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
          />
        </div>

        {usePass && password !== undefined && (
          <div className="sm:col-span-2">
            <label htmlFor="password" className="mb-2 inline-block text-sm text-gray-800 sm:text-base">
              パスワード:
            </label>
            <input
              className="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring"
              type="password"
              id="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
            />
          </div>
        )}
        {oldPassword && (
          <div className="sm:col-span-2">
            <label htmlFor="oldPassword" className="mb-2 inline-block text-sm text-gray-800 sm:text-base">
              以前のパスワード:
            </label>
            <p>パスワードは発行済みです。</p>
            <p>パスワードが不明な場合は上の入力欄から再発行をしてください。</p>
          </div>
        )}
      </div>
      <div className="space-x-4 mt-8">
        <button
          type="submit"
          className="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 active:bg-blue-700 disabled:opacity-50"
          disabled={isSubmitting}
        >
          {isSubmitting ? '更新中...' : 'ギルド情報を更新'}
        </button>
        <button
          type="button"
          className="py-2 px-4 bg-white border border-gray-200 text-gray-600 rounded hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50"
          onClick={() => {
            setGuildName(initialData.name);
            setDescription(initialData.description);
            setUsePass(initialData.use_pass);
            setOldPassword(initialData.old_password);
            setPassword('');
          }}
        >
          キャンセル
        </button>
      </div>
    </form>
  );
};

export default GuildSetForm;
