package com.session;

import java.io.*;
import java.text.SimpleDateFormat;
import javax.servlet.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

@WebServlet("/SessionServlet")
public class SessionServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    SimpleDateFormat sdf = new SimpleDateFormat("dd-MM-yyyy HH:mm:ss");

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        // Create or get existing session
        HttpSession session = request.getSession();

        // Prepare session data
        String sessionId = session.getId();
        String creationTime = sdf.format(session.getCreationTime());
        String lastAccessTime = sdf.format(session.getLastAccessedTime());

        // Send HTML response
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        out.println("<!DOCTYPE html><html><head><title>Session Info</title>");
        out.println("<style>");
        out.println("body { background: #34495e; color: white; font-family: Arial; display: flex; align-items: center; justify-content: center; height: 100vh; }");
        out.println(".box { background: rgba(255,255,255,0.1); padding: 30px; border-radius: 10px; }");
        out.println("</style></head><body>");
        out.println("<div class='box'>");
        out.println("<h2>Session Information</h2>");
        out.println("<p><strong>Session ID:</strong> " + sessionId + "</p>");
        out.println("<p><strong>Creation Time:</strong> " + creationTime + "</p>");
        out.println("<p><strong>Last Accessed:</strong> " + lastAccessTime + "</p>");
        out.println("</div></body></html>");
    }
}
