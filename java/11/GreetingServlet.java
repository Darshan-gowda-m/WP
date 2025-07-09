package com.greeting;

import java.io.*;
import java.time.*;
import javax.servlet.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

@WebServlet("/GreetingServlet")
public class GreetingServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        // Get current hour of server time
        int hour = LocalTime.now().getHour();
        String greeting;

        if (hour >= 5 && hour < 12) {
            greeting = "Good Morning User";
        } else if (hour >= 12 && hour < 17) {
            greeting = "Good Afternoon user ";
        } else if (hour >= 17 && hour < 21) {
            greeting = "Good Evening user";
        } else {
            greeting = "Good Night user ";
        }

        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        // Send styled HTML response
        out.println("<!DOCTYPE html>");
        out.println("<html><head><title>Greeting</title>");
        out.println("<style>");
        out.println("body { font-family: Arial; background: linear-gradient(to right, #0f2027, #203a43, #2c5364); color: white; height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; }");
        out.println(".box { background: rgba(255,255,255,0.1); padding: 40px; border-radius: 10px; text-align: center; }");
        out.println("h1 { font-size: 36px; }");
        out.println("</style></head><body>");
        out.println("<div class='box'>");
        out.println("<h1>" + greeting + "</h1>");
        out.println("<p>Server Time: " + LocalTime.now().withSecond(0).withNano(0) + "</p>");
        out.println("</div></body></html>");
    }
}
