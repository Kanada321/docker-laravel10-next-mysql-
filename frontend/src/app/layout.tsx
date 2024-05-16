import { ReactNode } from 'react';
import Header from '@/components/Header';
import Footer from '@/components/Footer';
import "./globals.css";

const Layout = ({ children }: { children: ReactNode }) => {
  return (
      <html lang="en">
      <head>
          <title>My Next.js App</title>
          <meta charSet="UTF-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      </head>
      <body>
      <Header/>
      <main>{children}</main>
      <Footer/>
      </body>
      </html>
  );
};

export default Layout;
