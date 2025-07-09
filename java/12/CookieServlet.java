package com.cookie;

import java.io.*;
import javax.servlet.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

@WebServlet("/CookieServlet")
public class CookieServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    // Handles form submission and creates cookie
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        String username = request.getParameter("username");

        // Create cookie
        Cookie cookie = new Cookie("username", username);
        cookie.setMaxAge(60 * 60); // 1 hour
        response.addCookie(cookie);

        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        out.println("<!DOCTYPE html><html><head><title>Cookie Created</title>");
        out.println("<style>");
        out.println("body { font-family: Arial; background: #2c3e50; color: white; display: flex; align-items: center; justify-content: center; height: 100vh; }");
        out.println(".box { background: rgba(255,255,255,0.1); padding: 30px; border-radius: 10px; }");
        out.println("a { color: #00c9a7; text-decoration: none; }");
        out.println("</style></head><body>");
        out.println("<div class='box'>");
        out.println("<h2>Hello, <strong>" + username + "</strong>!</h2>");
        out.println("<p>Cookie has been created and stored on your browser.</p>");
        out.println("<p><a href='CookieServlet'>Click here to read the cookie</a></p>");
        out.println("</div></body></html>");
    }

    // Handles GET request and reads cookie
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        String username = null;
        Cookie[] cookies = request.getCookies();

        if (cookies != null) {
            for (Cookie c : cookies) {
                if (c.getName().equals("username")) {
                    username = c.getValue();
                }
            }
        }

        out.println("<!DOCTYPE html><html><head><title>Cookie Read</title>");
        out.println("<style>");
        out.println("body { font-family: Arial; background: #34495e; color: white; display: flex; align-items: center; justify-content: center; height: 100vh; }");
        out.println(".box { background: rgba(255,255,255,0.1); padding: 30px; border-radius: 10px; }");
        out.println("</style></head><body>");
        out.println("<div class='box'>");

        if (username != null) {
            out.println("<h2>Welcome back, <strong>" + username + "</strong>!</h2>");
        } else {
            out.println("<h2>No cookie found.</h2>");
        }

        out.println("</div></body></html>");
    }
}
