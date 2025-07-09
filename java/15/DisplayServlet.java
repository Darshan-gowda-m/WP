package com.user;

import java.io.*;
import javax.servlet.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

@WebServlet("/DisplayServlet")
public class DisplayServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        String username = request.getParameter("username");
        String address = request.getParameter("address");

        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        out.println("<!DOCTYPE html><html><head><title>User Info</title>");
        out.println("<style>");
        out.println("body { margin: 0; font-family: Arial; background: linear-gradient(to right, #ff758c, #ff7eb3); display: flex; align-items: center; justify-content: center; height: 100vh; color: white; }");
        out.println(".box { background: rgba(0,0,0,0.4); padding: 40px; border-radius: 15px; text-align: center; }");
        out.println("h2 { margin-bottom: 20px; }");
        out.println("p { font-size: 18px; }");
        out.println("</style></head><body>");
        out.println("<div class='box'>");
        out.println("<h2>Hello, " + username + "!</h2>");
        out.println("<p><strong>Your Address:</strong><br>" + address.replaceAll("\n", "<br>") + "</p>");
        out.println("</div></body></html>");
    }
}
