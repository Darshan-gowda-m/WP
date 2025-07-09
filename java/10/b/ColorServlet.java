package com.bgcolor;

import java.io.*;
import javax.servlet.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

@WebServlet("/ColorServlet")
public class ColorServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        String bgColor = request.getParameter("bgColor");

        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        out.println("<!DOCTYPE html>");
        out.println("<html><head><title>Color Applied</title>");
        out.println("<style>");
        out.println("body { background-color: " + bgColor + "; font-family: Arial; display: flex; justify-content: center; align-items: center; height: 100vh; color: white; }");
        out.println(".box { background: rgba(0,0,0,0.5); padding: 30px; border-radius: 10px; }");
        out.println("</style>");
        out.println("</head><body>");
        out.println("<div class='box'>");
        out.println("<h1>Background color changed!</h1>");
        out.println("<p>Selected color: <strong>" + bgColor + "</strong></p>");
        out.println("</div></body></html>");
    }
}
