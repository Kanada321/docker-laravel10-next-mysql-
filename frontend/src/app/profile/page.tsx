"use client";

import ProfileForm from '@/components/ProfileForm';
import useAuth from '@/hooks/useAuth';

const ProfilePage = () => {
    const user = useAuth();

    if (!user) {
        return <div>Loading...</div>;
    }

    return (
        <div>
            <h1>Update Profile</h1>
            <ProfileForm />
        </div>
    );
};

export default ProfilePage;
